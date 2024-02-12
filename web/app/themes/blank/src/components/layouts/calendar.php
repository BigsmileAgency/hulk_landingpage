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
			<div class="slot">09:00</div>
			<div class="slot">10:00</div>
			<div class="slot">11:00</div>
			<div class="slot">14:00</div>
			<div class="slot">15:30</div>
			<div class="slot">16:00</div>
			<div class="slot">16:30</div>
		</div>
	</div>
	<button type="submit" id="book_btn">Réservez</button>
</form>


<script>
	let date = new Date();
	let fullDate = document.querySelector(".full_date")

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

		const months = [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December",
		];

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
			monthDays.innerHTML = days;
		}

		return date;
	};
	
	let daysArray = [];
	let timeArray = [];
	let month;
	let today;


	renderCalendar();
	handleSelection();

	document.querySelector(".prev").addEventListener("click", () => {
		prevMonth();
	});

	document.querySelector(".next").addEventListener("click", () => {
		nextMonth();
	});


	function handleSelection() {


		daysArray = Array.from(document.querySelectorAll('.day'));
		timeArray = Array.from(document.querySelectorAll('.slot'));
		today = document.querySelector('.today')

		function dateIsSelected(e) {
			const thisDate = e.target;
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
		}

		function timeIsSelected(e) {
			const thisTime = e.target;
			const otherTime = timeArray.filter(time => {
				return (time !== thisTime);
			})
			otherTime.forEach((e) => {
				e.classList.remove(('time_selected'))
			})
			thisTime.classList.add('time_selected')
		}

		daysArray.forEach((day) => {
			day.addEventListener('click', (e) => {
				if (e.target.classList.contains('prev_date')) {
					prevMonth(e);
				} else if (e.target.classList.contains('next_date')) {
					nextMonth(e);
				} else {
					dateIsSelected(e);
				}
			})
		})

		timeArray.forEach((time) => {
			time.addEventListener('click', (e) => {
				timeIsSelected(e);
			})
		})
	}

	console.log(date);


	function prevMonth() {
		date.setMonth(date.getMonth() - 1);
		date = renderCalendar();
		fullDate.innerHTML = date.toDateString();
		handleSelection();
	}

	function nextMonth() {
		date.setMonth(date.getMonth() + 1);
		date = renderCalendar();
		fullDate.innerHTML = date.toDateString();
		handleSelection();
	}
</script>