<div class="calendar">
	<div class="month">
		<i class="fas fa-angle-left prev"></i>
		<div class="date">
			<p class="month_display"></p>
			<p class="full_date"></p>
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

<script>
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

		let calendar = document.querySelector('.calendar')
		let daysArray = Array.from(calendar.querySelectorAll('.day'));

		console.log(daysArray);

		daysArray.forEach((day) => {
			day.addEventListener('click', (e) => {
				console.log(e.target.innerHTML);
			})
		})
	};

	document.querySelector(".prev").addEventListener("click", () => {
		date.setMonth(date.getMonth() - 1);
		renderCalendar();
	});

	document.querySelector(".next").addEventListener("click", () => {
		date.setMonth(date.getMonth() + 1);
		renderCalendar();
	});

	renderCalendar();
</script>