<div id="plugin_container">
	<p id="plugin_header">Pour bloquer / débloquer les créneaux : </p>
	<div class="booking_form">

		<div id="calendar_container">
			<div class="calendar">
				<div class="month">
					<p class="fas fa-angle-left prev">
						< </p>
							<div class="date">
								<p class="month_display"></p>
							</div>
							<p class="fas fa-angle-right next"> > </p>
				</div>

				<div class="weekdays">
					<div>L</div>
					<div>Ma</div>
					<div>Me</div>
					<div>J</div>
					<div>V</div>
					<div>S</div>
					<div>D</div>
				</div>
				<div class="days">
				</div>
			</div>
			<button class="plugin_btn" id="block_whole_day">Bloquer la journée</button>
			<button class="plugin_btn unblock" id="unblock_whole_day">Débloquer la journée</button>
		</div>

		<div class="time">
			<p class="full_date"></p>
			<div class="slots">
			</div>
			<button class="plugin_btn" id="block_slot">Bloquer créneau</button>
			<button class="plugin_btn unblock" id="unblock_slot">Débloquer créneau</button>
		</div>
	</div>

	<div id="custom_weekday_container">
		<form action="" id="make_custom_form">

			<select name="" id="make_custom_selecter">
				<option value="">--Choisisez un jour--</option>
				<!-- generate in js by showAllDaysAndAllSlots() -->
			</select>

			<fieldset id="make_custom_checkbox_container">
				<!-- generate in js by showAllDaysAndAllSlots() -->
			</fieldset>
			<input type="button" class="plugin_btn" id="custom_weekday_submit" value="Enregistrer">
		</form>
	</div>

	<div id="appointement_container">
		<button class="table_btn" id="futur_appointement">A venir</button>
		<button class="table_btn" id="past_appointement">Passé</button>
		<button class="table_btn" id="all_appointement">Tous</button>
		<table id="appointement_table" cellspacing="0" cellpadding="0">
			<thead>
				<tr class="thead">
					<th>Nom</th>
					<th>Prénom</th>
					<th>Entreprise</th>
					<th>Email</th>
					<th>Téléphone</th>
					<th>Date</th>
					<th>Heure</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody class="appointement"></tbody>
		</table>
	</div>
</div>

<style>
	#custom_weekday_container {
		margin: 2rem 0;
		padding: 5px;
		border: 1px solid grey;
		border-radius: 5px;
		max-width: 750px;
	}
	
	#make_custom_selecter {
		margin: 1rem 0;
		width: 80%;
	}

	.table_btn {
		color: #33AAFF;
		padding: .7rem 1rem;
		border-radius: 50px;
		cursor: pointer;
		border: none;
		background-color: white;
		margin-bottom: .5rem;
		margin-right: .5rem;
	}

	.table_btn:hover {
		background-color: transparent;
		transform: scale(1.1);
		transition: .5s;
	}

	#appointement_table {
		display: none;
	}

	#make_custom_checkbox_container {
		max-height: 12vh;
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
	}

	#appointement_container {
		width: fit-content;
	}

	#appointement_table {
		background-color: rgba(51, 170, 255, .3);
		padding: 5;
		border-radius: 5px 5px 0px 0px;
		border: 3px solid transparent;
	}

	#appointement_table .thead {
		border: 1px solid black;
		border-radius: 10px;
	}

	#appointement_table td {
		border: solid 1px grey;
		padding: 5px 10px;
		min-width: 70px;
		background-color: white;
	}

	#appointement_table a {
		font-weight: 600;
	}

	#no_appointement {
		text-align: center;
		font-size: 22px;
		text-decoration: underline;
		color: brown;
	}

	#plugin_container {
		margin: 2rem;
		width: 70%;
	}

	#plugin_container .plugin_btn {
		margin: 2rem auto;
		border-radius: 50px;
		padding: 0.7em 1em;
		border: solid 2px #33AAFF;
		font-size: 12px;
		background-color: rgba(255, 255, 255, 0);
		color: #33AAFF;
	}

	#plugin_container .plugin_btn:hover {
		border: solid 2px #0095FF;
		cursor: pointer;
		transform: scale(1.05);
		transition: 0.25s ease-out;
		background-color: #0095FF;
		color: #ffffff;
	}

	#plugin_container .unblock {
		border: solid 2px green;
		background-color: rgba(255, 255, 255, 0);
		color: green;
	}

	#plugin_container .unblock:hover {
		border: solid 2px green;
		cursor: pointer;
		transform: scale(1.05);
		transition: 0.25s ease-out;
		color: white;
		background-color: green;
	}

	#plugin_header {
		font-size: 1.5rem;
	}

	.booking_form {
		max-width: 750px;
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 1rem;
	}

	@media (max-width: 768px) {
		.booking_form {
			grid-template-columns: 1fr;
			gap: 0rem;
		}
	}

	.booking_form p {
		margin-bottom: 0;
	}


	.booking_form .time {
		max-width: 280px;
	}

	.booking_form .time .full_date {
		margin-bottom: 1rem;
	}

	.booking_form .time .slots {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
	}

	.booking_form .time .slot {
		padding: 10px 4px;
		border: solid 2px grey;
		border-radius: 5px;
		margin: 5px;
	}

	.booking_form .time .slot:hover {
		background-color: #33AAFF;
		color: #ffffff;
		cursor: pointer;
	}

	.booking_form .time .time_selected {
		background-color: #33AAFF;
		color: white;
	}

	.booking_form .time .unavailable {
		background-color: rgb(168, 168, 168);
		opacity: 0.7;
	}

	.booking_form .calendar {
		border: solid 2px grey;
		border-radius: 5px;
		padding-bottom: 2px;
		max-width: 280px;
	}

	.booking_form .calendar .month_display {
		font-size: 24px;
		margin-bottom: 0.5rem;
	}

	.booking_form .calendar .month {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0 2rem;
		margin-bottom: 1rem;
	}

	.booking_form .calendar .month p {
		font-size: 20px;
		cursor: pointer;
	}

	.booking_form .calendar .weekdays {
		display: grid;
		grid-template-columns: repeat(7, 1fr);
		place-items: center;
		margin-bottom: 0.5rem;
	}

	.booking_form .calendar .days {
		width: 100%;
		display: grid;
		grid-template-columns: repeat(7, 1fr);
		grid-template-rows: repeat(6, 1fr);
		overflow: hidden;
	}

	.booking_form .calendar .days .day {
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		padding: 8px;
		margin: 2px;
		background-color: rgba(51, 170, 255, 0.137254902);
		border-radius: 5px;
		border: solid 2px transparent;
	}

	.booking_form .calendar .days .day:hover {
		background-color: #33AAFF;
	}

	.booking_form .calendar .days .today {
		border: solid 2px #33AAFF;
	}

	.booking_form .calendar .days .date_selected {
		background-color: #33AAFF;
		color: white;
	}

	.booking_form .calendar .days .prev_date,
	.booking_form .calendar .days .next_date {
		opacity: 0.5;
	}
</style>