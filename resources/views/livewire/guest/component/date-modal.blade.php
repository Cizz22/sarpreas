<div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
    <!-- Modal content -->
    <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                Tanggal Reservasi
            </h3>
            <button type="button" onclick="Livewire.emit('closeModal')"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <!-- Modal body -->
        <!-- component -->
        <div class="mx-auto p-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="flex items-center justify-between px-6 py-3 bg-gray-700">
                    <button id="prevMonth" class="text-white">Previous</button>
                    <h3 id="currentMonth" class="text-white"></h3>
                    <button id="nextMonth" class="text-white">Next</button>
                </div>


                <div class="grid grid-cols-7 gap-2 p-4" id="calendar">
                    <!-- Calendar Days Go Here -->
                </div>


                <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

                    <div
                        class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content py-4 text-left px-6">
                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold">Selected Date</p>
                                <button id="closeModal"
                                    class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                            </div>
                            <div id="modalDate" class="text-xl font-semibold"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>

            function generateCalendar(year, month) {
                const calendarElement = document.getElementById('calendar');
                const currentMonthElement = document.getElementById('currentMonth');

                // Create a date object for the first day of the specified month
                const firstDayOfMonth = new Date(year, month, 1);
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Clear the calendar
                calendarElement.innerHTML = '';

                // Set the current month text
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                    'August', 'September',
                    'October', 'November', 'December'
                ];
                currentMonthElement.innerText = `${monthNames[month]} ${year}`;

                // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
                const firstDayOfWeek = firstDayOfMonth.getDay();

                // Create headers for the days of the week
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                daysOfWeek.forEach(day => {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center font-semibold';
                    dayElement.innerText = day;
                    calendarElement.appendChild(dayElement);
                });

                // Create empty boxes for days before the first day of the month
                for (let i = 0; i < firstDayOfWeek; i++) {
                    const emptyDayElement = document.createElement('div');
                    calendarElement.appendChild(emptyDayElement);
                }

                // Create boxes for each day of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 border cursor-pointer';
                    dayElement.innerText = day;

                    // Check if this date is the current date
                    const currentDate = new Date();
                    if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day ===
                        currentDate
                        .getDate()) {
                        dayElement.classList.add('bg-blue-500',
                            'text-white'); // Add classes for the indicator
                    }

                    //Check if this date is already booked
                    const bookedDate = new Date(2021, 9, 10)

                    if (month === bookedDate.getMonth() && day === bookedDate
                        .getDate()) {
                        dayElement.classList.add('bg-red-500',
                            'text-white'); // Add classes for the indicator
                    }

                    calendarElement.appendChild(dayElement);
                }
            }

            // Initialize the calendar with the current month and year
            const currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth();


            generateCalendar(currentYear, currentMonth);

            // Event listeners for previous and next month buttons
            document.getElementById('prevMonth').addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentYear, currentMonth);
            });

            document.getElementById('nextMonth').addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentYear, currentMonth);
            });

            document.addEventListener('livewire:load', function() {



            })


            // Initialize the calendar with the current month and year
            // const currentDate = new Date();
            // let currentYear = currentDate.getFullYear();
            // let currentMonth = currentDate.getMonth();


            // generateCalendar(currentYear, currentMonth);

            // // Event listeners for previous and next month buttons
            // document.getElementById('prevMonth').addEventListener('click', () => {
            //     currentMonth--;
            //     if (currentMonth < 0) {
            //         currentMonth = 11;
            //         currentYear--;
            //     }
            //     generateCalendar(currentYear, currentMonth);
            // });

            // document.getElementById('nextMonth').addEventListener('click', () => {
            //     currentMonth++;
            //     if (currentMonth > 11) {
            //         currentMonth = 0;
            //         currentYear++;
            //     }
            //     generateCalendar(currentYear, currentMonth);
            // });

            // Function to show the modal with the selected date
            function showModal(selectedDate) {
                const modal = document.getElementById('myModal');
                const modalDateElement = document.getElementById('modalDate');
                modalDateElement.innerText = selectedDate;
                modal.classList.remove('hidden');
            }

            // Function to hide the modal
            function hideModal() {
                const modal = document.getElementById('myModal');
                modal.classList.add('hidden');
            }

            // Event listener for date click events
            const dayElements = document.querySelectorAll('.cursor-pointer');
            dayElements.forEach(dayElement => {
                dayElement.addEventListener('click', () => {
                    const day = parseInt(dayElement.innerText);
                    const selectedDate = new Date(currentYear, currentMonth, day);
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = selectedDate.toLocaleDateString(undefined, options);
                    showModal(formattedDate);
                });
            });

            // Event listener for closing the modal
            document.getElementById('closeModal').addEventListener('click', () => {
                hideModal();
            });
        </script>


        <!-- Modal footer -->
        <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-toggle="default-modal" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                accept</button>
            <button data-modal-toggle="default-modal" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Decline</button>
        </div>
    </div>
</div>
</div>
