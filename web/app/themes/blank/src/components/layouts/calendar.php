<div class="booking_form">
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
</div>

<button id="book_btn">Réservez</button>

<script>
	let apointement = 0;
	const date = new Date();

	const renderCalendar = () => {

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

		document.querySelector(".full_date").innerHTML = new Date().toDateString();

		let days = "";

		for (let x = firstDayIndex; x > 0; x--) {
			days += `<div class="day prev_date">${prevLastDay - x + 1}</div>`;
		}

		for (let i = 1; i <= lastDay; i++) {
			if (
				i === new Date().getDate() &&
				date.getMonth() === new Date().getMonth()
			) {
				days += `<div class="day today">${i}</div>`;
			} else {
				days += `<div class="day">${i}</div>`;
			}
		}

		for (let j = 1; j <= nextDays; j++) {
			days += `<div class="day next_date">${j}</div>`;
			monthDays.innerHTML = days;
		}
	};
</script>