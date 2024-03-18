# WIL Industry Placement Project Allocation System

This web application facilitates the allocation of students to Work Integrated Learning (WIL) projects. The system streamlines the process by allowing industry partners to advertise projects, enabling students to apply for preferred projects, and facilitating the assignment of students to projects. It also provides a automated mass assignment functionality.

## Demonstration Video
[![WIL Demonstration](https://img.youtube.com/vi/IcBs-lKqAtQ/0.jpg)](https://youtu.be/IcBs-lKqAtQ)

## Tech Stack
- Laravel with Blade
- Eloquent ORM
- PHP
- Tailwind CSS
- Vite

## ER Diagram of SQLite Database
<img width="1238" alt="Diagram" src="https://github.com/toshimitsu-o/WIL/assets/89127228/f31e2adb-3d27-4559-84a8-96f667d9c97f">

## Key Features

### Authentication and User Types
- Implemented user registration, login, and permissions for three user types: industry partners, teachers, and students.
- User type is prominently displayed at the top of the application.
### Dashboard
- Presents a paginated list of industry partners with links to details pages showcasing their projects.
- Ensures a seamless navigation experience for users with login/logout links.
### Project Management
- Industry partners can add, edit, and delete projects.
- Error handling prevents the deletion of projects with existing applications.
- Projects are unique within the same offering and are organized in reverse chronological order.
- Supports the uploading of multiple image/PDF files to enhance project descriptions.
### Applications
- Students can apply to up to three projects.
- Project pages display a list of applicants and their assignments.
### Teacher Approval:
- Industry partners require approval from teachers before creating projects.
- Teachers have access to student profiles and can use the auto assign feature for efficient project allocation.
### Student Information
- Applications from students include GPA and preference information, such as role preferences, skillsets, and industry preferences.
### Data Seeding
Seeders and factory services are employed to generate all necessary test data for application testing.
### Auto Assign Algorithm
- Teachers can use the auto assign feature to automatically allocate students to projects.
- The algorithm considers GPA, role preferences, skillsets, and industry preferences to maximize matching scores.
- It sorts students by GPA to maximise the probability of students in a team with similar GPA. It loops through projects they applied to calculate matching scores using preference data. Role has the highest score and industry match receives the lowest score. After scoring all three applications, the highest project will be allocated to the student. After this process, remained students will be assigned to any projects. This algorithm mostly satisfies the requirements of allocating at least one role matched for projects, teammates with similar GPA, team capacities will be filled from popular projects, and mostly matched preference for both students and IPs.

## Project Reflection
The development started by testing Auth services to ensure that all worked and get familiar with the features. Building database with migrations was carried out next then moved to developing project functionalities. Tailwind was used to style the UI components and Git was used for version control. The course materials covered most parts of the development; however, frequent research and reading Laravel documentation were needed to build the advanced parts. MVC separation was challenging at first, although, it started making sense towards the end. Eloquent was robust and convenient for data manipulation. The most challenging part in the development was the auto assignment which required me to contemplate on it to consider several ways to assign students to projects. Nonetheless, I did not have enough time to rigorously test and tune my algorithm. I would like to challenge similar problems to improve my algorithm development skills in the future.
