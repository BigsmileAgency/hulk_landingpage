<form class="booking_form">
	<div class="calendar">
		<div class="month">
			<i class="fas fa-angle-left prev"></i>
			<div class="date">
				<p class="month_display"></p>
			</div>
			<i class="fas fa-angle-right next"></i>
		</div>

		<div class="weekdays">
			<div>M</div>
			<div>Tue</div>
			<div>W</div>
			<div>Thu</div>
			<div>F</div>
			<div>S</div>
			<div>Sun</div>
		</div>

		<div class="days">
		</div>
	</div>

	<div class="time">
		<p class="full_date"></p>
		<div class="slots">
		</div>
	</div>
	<button type="submit" id="book_btn">Réservez</button>
</form>

<script>
	let date = new Date();
	let fullDate = document.querySelector(".full_date");

	function renderCalendar() {

		date.setDate(1);

		const monthDays = document.querySelector(".days");

		const lastDay = new Date(
			date.getFullYear(),
			date.getMonth() + 1,
			0
		).getDate();

		const prevLastDay = new Date(
			date.getFullYear(),
			date.getMonth(),
			0
		).getDate();

		const firstDayIndex = date.getDay() - 1;

		const lastDayIndex = new Date(
			date.getFullYear(),
			date.getMonth() + 1,
			0
		).getDay();

		const nextDays = 7 - lastDayIndex;

		const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

		document.querySelector(".month_display").innerHTML = months[date.getMonth()];

		fullDate.innerHTML = new Date().toDateString();

		let days = "";

		for (let x = firstDayIndex; x > 0; x--) {
			days += `<div class="day prev_date">${prevLastDay - x + 1}</div>`;
		}

		for (let i = 1; i <= lastDay; i++) {						
			if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
				days += `<div class="day today">${i}</div>`;
			} else {
				days += `<div class="day">${i}</div>`;
			}
		}

		for (let j = 1; j <= nextDays; j++) {
			days += `<div class="day next_date">${j}</div>`;
		}

		monthDays.innerHTML = days;
		return date;
	};


	renderCalendar();
	getTheSlots(fullDate.innerHTML);

	document.querySelector(".prev").addEventListener("click", () => {
		prevMonth();
	});

	document.querySelector(".next").addEventListener("click", () => {
		nextMonth();
	});

	let handler = false;

	function handleSelection() {

		console.log('handle selection');

		let daysArray = Array.from(document.querySelectorAll('.day'));
		let timeArray = Array.from(document.querySelectorAll('.slot'));
		let today = document.querySelector('.today');

		function dateIsSelected(e) {
			let thisDate = e.target;
			const otherDates = daysArray.filter(date => {
				return (date !== thisDate);
			})
			otherDates.forEach((e) => {
				e.classList.remove('date_selected')
				if (e.classList.contains('today')) {
					e.classList.remove('today')
				}
			})
			thisDate.classList.add('date_selected')
			date.setDate(thisDate.innerHTML)
			fullDate.innerHTML = date.toDateString();
			getTheSlots(fullDate.innerHTML);
		}


		function timeIsSelected(e) {
			let thisTime = e.target;
			const otherTime = timeArray.filter(time => {
				return (time !== thisTime);
			})
			otherTime.forEach((e) => {
				e.classList.remove(('time_selected'))
			})
			thisTime.classList.add('time_selected')
		}

		let callIt = false;
		daysArray.forEach((day) => {
			day.addEventListener('click', (e) => {
				if (e.target.classList.contains('prev_date')) {
					date.setMonth(date.getMonth() - 1);
					renderCalendar()
					if (!callIt) {
						dateIsSelected(e);
						callIt = true;
					}
				} else if (e.target.classList.contains('next_date')) {
					date.setMonth(date.getMonth() + 1);
					renderCalendar()
					if (!callIt) {
						dateIsSelected(e);
						callIt = true;
					}
				} else {
					date.setDate(day.innerHTML)
					if (!callIt) {
						dateIsSelected(e);
						callIt = true;
					}
				}
			})
		})


		timeArray.forEach((time) => {
			time.addEventListener('click', (e) => {
				timeIsSelected(e);
			})
		})

	}


	function prevMonth() {
		date.setMonth(date.getMonth() - 1);
		date = renderCalendar();
		fullDate.innerHTML = date.toDateString();
		getTheSlots(fullDate.innerHTML);
	}


	function nextMonth() {
		date.setMonth(date.getMonth() + 1);
		date = renderCalendar();
		fullDate.innerHTML = date.toDateString();
		getTheSlots(fullDate.innerHTML);
	}


	function getTheSlots(date) {

		date = new Date(date);
		let year = date.getFullYear();
		let month = ("0" + (date.getMonth() + 1)).slice(-2);
		let day = ("0" + date.getDate()).slice(-2);
		let formatedDate = year + "-" + month + "-" + day;

		let xhr = new XMLHttpRequest();
		let url = '<?= admin_url('admin-ajax.php') ?>';
		let dataSet = 'action=get_the_slots&date=' + formatedDate;

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let result = xhr.responseText;
				result = JSON.parse(result);
				if (!result.error) {
					showSlots(result)
				} else {
					console.log(result);
				}
			}
		};
		xhr.send(dataSet);
	}


	function showSlots(result) {

		let slots = document.querySelector('.slots')
		let allSlots = result.all_slots;
		let takenSlots = result.taken_slot

		slotsDisplay = ""

		allSlots.map((e) => {
			slotsDisplay += `<div class="slot">${e.time}</div>`
		})

		slots.innerHTML = slotsDisplay;

		if (takenSlots.length > 0) {
			timeArray = Array.from(document.querySelectorAll('.slot'));
			takenSlots.map((e) => {
				timeArray.map((f) => {
					if (e == f.innerHTML) {
						f.classList.add('unavailable')
					}
				})
			})
		}


		handleSelection();
	}
</script>