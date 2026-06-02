# COMNETICS Internal Portal

COMNETICS Internal Portal is a deliberately vulnerable web application built for a CTF web exploitation challenge. The application simulates an internal event management portal for COMNETICS 2026, where users can log in, access a dashboard, and attempt to escalate their privileges to access the admin-only flag.

This challenge is designed to help participants understand basic web security concepts, especially SQL Injection through cookie manipulation, sensitive file discovery, and access control weaknesses.

## Features

- PHP-based login system
- SQLite database integration
- Guest and admin user roles
- Cookie-based session logic
- Hidden sensitive files for enumeration
- Admin-only flag display
- Dockerized deployment

## Tech Stack

- PHP
- SQLite3
- HTML/CSS
- Docker
- Docker Compose

## Challenge Category

Web Exploitation / SQL Injection / Cookie Manipulation

## Disclaimer

This project is intentionally vulnerable and created only for educational and CTF purposes. Do not deploy this application as a production system.
