# Sudoku-solver
A specialized Sudoku solver that uses advanced deductive logic to solve puzzles step-by-step. 
## 🌟 Overview
Unlike many solvers that rely solely on brute-force (backtracking), this engine implements human-like reasoning techniques to find solutions and explain the process.

### Solving Techniques Included:
* **Singles (Naked/Hidden):** Identifies cells with only one possible candidate.
* **N-tuplets (Pairs/Triplets):** Detects linked candidates across rows, columns, and squares.
* **Line-Square Intersections:** Logical elimination based on intersecting regions.
* **Step-by-Step Execution:** Allows the user to visualize each logical deduction (the "Giro" function).

## 🛠 Technology Stack
* **Web Frontend:** HTML5, CSS3, JavaScript (Vanilla)
* **Backend:** PHP 8.x
* **Data Exchange:** JSON/AJAX

## 🚀 Features
- **Interactive Grid:** A responsive 9x9 grid for manual entry or automatic solving.
- **Solving Log:** A dedicated "Memo" area that tracks every logical operation performed by the engine.
- **Deductive Logic Toggle:** Enable or disable specific solving algorithms (Singles, Pairs, etc.) via the UI.
- **File Management:** Save and load Sudoku schemes (Legacy `.txt` format support).

## 📂 Project Structure
- `index.php`: The main user interface and solution logic.
- `api_sudoku.php`: The DataBase interface.

## ⚙️ Installation & Usage
You can use the program in my site:
https://orsuccimarzio.altervista.org/Sudoku/index.php

or install in your
1.  Clone this repository:
    ```bash
    git clone [https://github.com/your-username/sudoku-solver-port.git](https://github.com/your-username/sudoku-solver-port.git)
    ```
2.  Deploy to a PHP-enabled server (e.g., Apache, Nginx, or local environments like XAMPP/MAMP).
3.  Open `index.php` in your browser.
4.  Enter the Sudoku numbers and click **"Passo"** to perform a single step or **"Solve All"** for the complete solution.

🗄️ Database Setup & Scheme Registration
By default, the web port performs logic calculations in-memory. If you wish to enable the "Register/Save Scheme" feature (equivalent to the RegistraClick function in the original source), follow these steps:

Initialize the Database:
Execute the provided tabella.sql script in your SQL environment (e.g., MySQL or MariaDB). This will create the necessary table structure to store the 9x9 grids and their metadata.

Configure the API:
Open the api_sudoku file and customize the database connection strings. You must provide your specific:

DB_HOST

DB_NAME

DB_USER

DB_PASSWORD

Permissions:
Ensure your web server has the appropriate permissions to execute queries through the API to allow for persistent storage of your Sudoku puzzles.

## 📝 Historical Note
This project represents a bridge between legacy desktop development and modern web applications. The core algorithm preserves the original logic written in the early 2000s, adapting the VCL (Visual Component Library) event-driven model to a stateless web environment.

## 📄 License
This project is licensed under the MIT License - see the LICENSE file for details.
