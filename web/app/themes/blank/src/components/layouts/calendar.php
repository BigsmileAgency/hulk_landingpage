<?php
$lang = get_language_attributes($doctype = "html");
?>

<div class="booking_form">
	<div class="calendar">
		<div class="month">
			<i class="fas fa-angle-left prev"></i>
			<div class="date">
				<p class="month_display"></p>
			</div>
			<i class="fas fa-angle-right next"></i>
		</div>

		<?php if ($lang == 'lang="fr-FR"') : ?>
			<div class="weekdays">
				<div>L</div>
				<div>Ma</div>
				<div>Me</div>
				<div>J</div>
				<div>V</div>
				<div>S</div>
				<div>D</div>
			</div>

		<?php elseif ($lang == 'lang="en-EN"' || $lang == 'lang="en-US"') : ?>
			<div class="weekdays">
				<div>M</div>
				<div>Tue</div>
				<div>W</div>
				<div>Thu</div>
				<div>F</div>
				<div>S</div>
				<div>Sun</div>
			</div>

		<?php elseif ($lang == 'lang="nl-NL"' || $lang == 'lang="nl-BE"') : ?>
			<div class="weekdays">
				<div>Ma</div>
				<div>Di</div>
				<div>Wo</div>
				<div>Do</div>
				<div>Vr</div>
				<div>Za</div>
				<div>Zo</div>
			</div>
		<?php endif; ?>

		<div class="days">
		</div>
	</div>

	<div class="time">
	<i class="fas fa-angle-left prev"></i>
		<p class="full_date"></p>
		<i class="fas fa-angle-right next"></i>
		<div class="slots">
		</div>
	</div>
</div>

<script>
	let fullDate = document.querySelector(".full_date");
	let date = new Date();

	function renderCalendar() {

		// make week start on monday
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

		const lastDayIndex = new Date(
			date.getFullYear(),
			date.getMonth() + 1,
			0
		).getDay();

		// unless the month start on sunday it will skew everything:
		const firstDayIndex = date.getDay() == 0 ? 6 : date.getDay() - 1;

		const months = {
			"en": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			"fr": ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
			"nl": ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"],
		}

		document.querySelector(".month_display").innerHTML = months[lang][date.getMonth()];

		if (lang == "fr") {
			let dateFr = new Date().toDateString();
			fullDate.innerHTML = dateInFr(dateFr);
		} else if (lang == "nl") {
			let dateFr = new Date().toDateString();
			fullDate.innerHTML = dateInNl(dateFr);
		} else {
			let dateEn = new Date().toDateString();
			fullDate.innerHTML = dateInEn(dateEn);
		}

		let days = "";
		totalDays = 0;

		for (let x = firstDayIndex; x > 0; x--) {
			days += `<div class="day prev_date">${prevLastDay - x + 1}</div>`;
			totalDays++
		}

		for (let i = 1; i <= lastDay; i++) {
			if (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) {
				days += `<div class="day today">${i}</div>`;
			} else {
				days += `<div class="day">${i}</div>`;
			}
			totalDays++
		}

		const nextDays = 42 - totalDays;
		for (let j = 1; j <= nextDays; j++) {
			days += `<div class="day next_date">${j}</div>`;
		}

		monthDays.innerHTML = days;
		return date;
	};

	getTheSlots(date);
	renderCalendar();

	document.querySelector(".prev").addEventListener("click", () => {
		prevMonth();
	});

	document.querySelector(".next").addEventListener("click", () => {
		nextMonth();
	});


	function handleSelection() {

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
			})
			thisDate.classList.add('date_selected')
			date.setDate(thisDate.innerHTML)
			if (lang == "fr") {
				fullDate.innerHTML = dateInFr(date)
			} else if (lang == "nl") {
				fullDate.innerHTML = dateInNl(date)
			} else {
				fullDate.innerHTML = dateInEn(date);
			}
			getTheSlots(date);
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
		let selectClass = 0;
		daysArray.forEach((day) => {
			if (day.classList.contains('date_selected')) {
				selectClass++
			}
			day.addEventListener('click', (e) => {
				if (e.target.classList.contains('prev_date')) {
					if (!callIt) {
						renderCalendar()
						dateIsSelected(e);
						date.setMonth(date.getMonth() - 1);
						callIt = true;
					}
				} else if (e.target.classList.contains('next_date')) {
					if (!callIt) {
						date.setMonth(date.getMonth() + 1);
						renderCalendar()
						dateIsSelected(e);
						callIt = true;
					}
				} else {
					date.setDate(day.innerHTML)
					if (!callIt) {
						callIt = true;
						dateIsSelected(e);
					}
				}
			})
		})

		if (!selectClass) {
			let whatDay = fullDate.innerHTML.split(' ').filter((e) => /^\d{1,2}$/.test(e)).join('');
			whatDay = whatDay.replace(/\b0+(\d+)/g, "$1")
			daysArray.forEach((day) => {
				if (day.innerHTML == whatDay && !day.classList.contains('prev_date') && !day.classList.contains('next_date')) {
					day.classList.add('date_selected')
				}
			})
		}

		timeArray.forEach((time) => {
			time.addEventListener('click', (e) => {
				timeIsSelected(e);
			})
		})
	}

	function prevMonth() {
		date.setMonth(date.getMonth() - 1);
		date = renderCalendar();
		if (lang == "fr") {
			fullDate.innerHTML = dateInFr(date)
		} else if (lang == "nl") {
			fullDate.innerHTML = dateInNl(date)
		} else {
			fullDate.innerHTML = dateInEn(date)
		}
		getTheSlots(date);
	}


	function nextMonth() {
		date.setMonth(date.getMonth() + 1);
		date = renderCalendar();
		if (lang == "fr") {
			fullDate.innerHTML = dateInFr(date)
		} else if (lang == "nl") {
			fullDate.innerHTML = dateInNl(date)
		} else {
			fullDate.innerHTML = dateInEn(date);
		}
		getTheSlots(date);
	}

	function getTheSlots(date) {

		let year = date.getFullYear();
		let month = ("0" + (date.getMonth() + 1)).slice(-2);
		let day = ("0" + date.getDate()).slice(-2);
		let formatedDate = year + "-" + month + "-" + day;

		let xhr = new XMLHttpRequest();
		let url = '<?= admin_url('admin-ajax.php') ?>';
		let dataSet = 'action=get_the_slots&date=' + formatedDate + '&week_day=' + date.getDay();

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

		slotsDisplay = ""
		let slots = document.querySelector('.slots')
		let allSlots = result.all_slots;
		let takenSlots = result.taken_slot

		let selectedDate = new Date(date);
		let now = new Date();
		now.setHours(0, 0, 0, 0);

		if (date.getDay() === 0 || date.getDay() === 6 || selectedDate < now) {
			allSlots.map((e) => {
				slotsDisplay += `<div class="slot unavailable">${e.time}</div>`
			})
			slots.innerHTML = slotsDisplay;
		} else {
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
		}
		handleSelection();
	}


	function dateInFr(date) {
		let selectedDate = new Date(date);
		let dayOfWeek = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
		return dayOfWeek[selectedDate.getDay()] + " " + selectedDate.getDate();
	}

	function dateInNl(date) {
		let selectedDate = new Date(date);
		let dayOfWeek = ["Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag"];
		return dayOfWeek[selectedDate.getDay()] + " " + selectedDate.getDate();
	}

	function dateInEn(date){
		let selectedDate = new Date(date);
		let dayOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		return dayOfWeek[selectedDate.getDay()] + " " + selectedDate.getDate();
	}

</script>