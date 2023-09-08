# Class Schedule Generator

The Class Schedule Generator is a web-based application designed to streamline the process of creating class schedules for educational institutions. This project aims to automate the scheduling of courses, teachers, and rooms for different batches and semesters, ensuring efficient allocation of resources and minimizing scheduling conflicts.

## Table of Contents

-  [Introduction](#introduction)
-  [Features](#features)
-  [Getting Started](#getting-started)
-  [Usage](#usage)
-  [Technologies Used](#technologies-used)
-  [Database Structure](#database-structure)
-  [How It Works](#how-it-works)
-  [Contributing](#contributing)
-  [License](#license)

## Introduction

The Class Schedule Generator is an essential tool for educational institutions to optimize the allocation of classes, teachers, and rooms. By automating the scheduling process, it reduces manual effort, improves scheduling accuracy, and allows for easy adjustments based on changing requirements.

## Features

-  **Batch and Semester Selection:** Choose a specific batch and semester for which you want to generate a class schedule.

-  **Automatic Schedule Generation:** The system automatically generates a class schedule based on predefined criteria, such as course availability, teacher preferences, and room capacity.

-  **Teacher and Room Availability:** Ensure that teachers and rooms are available during the specified time slots, avoiding scheduling conflicts.

-  **Customization:** The schedule generation process can be customized to accommodate factors like course credits, time slots, and more.

-  **Interactive Interface:** The user-friendly web interface makes it easy to input batch and semester details and view generated schedules.

## Getting Started

1. Clone this repository to your local machine.
2. Set up a web server (e.g., Apache) and PHP environment.
3. Import the provided SQL file to create the necessary database tables.
4. Configure the database connection in the `config.php` file.
5. Access the application through your web browser.

## Usage

1. Launch the application in your web browser.
2. Select a batch and semester from the dropdown menus.
3. Click the "Generate Schedule" button to generate the class schedule.
4. View the generated schedule, which includes day, time, course, teacher, and room information.
5. Make adjustments as needed and save the final schedule.

## Technologies Used

-  HTML, CSS, JavaScript
-  PHP (Hypertext Preprocessor)
-  MySQL (Database Management System)
-  jQuery (JavaScript Library)
-  AJAX (Asynchronous JavaScript and XML) for dynamic interactions

## Database Structure

The database should include the following tables:

-  `batch` (batch_id, batch_number, department_id, batch_shift)
-  `semester` (semester_id, semester_name, department_id)
-  `course` (course_id, course_code, course_name, credits, department_id, semester_id)
-  `teacher` (teacher_id, teacher_name)
-  `room` (room_id, room_name, capacity)
-  `schedule` (schedule_id, batch_id, semester_id, day, time_slot, course_id, teacher_id, room_id)

## How It Works

The Class Schedule Generator leverages a sophisticated algorithm to allocate courses, teachers, and rooms based on the provided input. It considers various constraints, such as teacher availability, room capacity, and course prerequisites, to create an optimal class schedule. The generated schedule is stored in the database for easy access and management.

## Contributing

Contributions to this project are welcomed and encouraged. If you encounter issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

\*\* need to install composer
use: composer require mpdf/mpdf
