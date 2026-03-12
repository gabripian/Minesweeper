# Prato Fiorito - Minesweeper Web App

The project is about the game **"Prato Fiorito"**, an enhanced web version of **Minesweeper**. It adds a **national and global leaderboard** to make it more competitive. The game runs on **XAMPP** or any web server and uses **MySQL** for user data and rankings.

## Features
- **User Registration/Login**: Required to play and access leaderboards
- **3 Difficulty Levels**: Easy (default), Medium, Hard
- **National & Global Leaderboards**: Score based on time + difficulty
- **Personal Statistics**: Games played, wins, win percentage
- **Flag & Question Mark System**: Right-click to mark suspected mines
- **Italian Language Interface**

## Technical Setup
It contains a database generation script inside **"script_database.txt"**.

**To create the database using XAMPP:**
1. Open **phpMyAdmin**: `localhost/phpMyAdmin`
2. Execute the `script_database.txt` script

**To run the game using XAMPP:**
1. Place project folder in XAMPP's **"htdocs"** folder
2. Access via browser: `localhost/project_folder_name`

## Registration Rules
All fields are **mandatory** with specific validation:
- **Username**: 5-20 chars (letters, digits, underscore `_`)
- **Email**: Standard format (`user@domain.xx/xxx`)
- **Password**: 5-20 chars (no spaces)

If username exists, user must choose another one.

## Game Rules
- **Left-click** a cell to reveal (the first click starts timer)
- **Right-click** first time = Flag (blocks cell)
- **Right-click** second time = Question mark (allows reveal)
- **Win**: Reveal all safe cells
- **Lose**: Hit a mine
- **Timer**: Pauses when opening menu, resumes on return

## Player Flow
1. **Register** → Form validation → Success message
2. **Login** → Game screen (Easy mode default)
3. **Left Menu**:
   - Game rules
   - Difficulty selection (confirm required)
   - Statistics + Leaderboards
   - Logout
4. **Play** → Earn score → Update rankings

**Scoring**: Time-based + difficulty multiplier (detailed in "How to Play" menu section)

The game is fully in **Italian**.
