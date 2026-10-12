# Weather SMS Service

## Overview
The Weather SMS Service is designed for use in areas with fickle cell service availability. In regions where internet connectivity is unavailable but a 2G signal for SMS exists, this service provides critical weather information.

Features include:
- Sending weather outlooks for pre-selected locations via SMS.
- Responding to user queries for specific place names via text message.

## Requirements
- Docker and Docker Compose
- Raspberry Pi or similar machine with a USB GSM Hat (at `/dev/ttyUSB0`)
- Meteoblue API Key (Free Weather API)

## Setup
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd weather-sms-service
   ```
2. Configure environment variables:
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and provide your `METEOBLUE_API_KEY`.

3. Install dependencies via containerized Composer:
   ```bash
   docker-compose run --rm composer install
   ```

## Running the Service
To start the services (PHP app and MySQL):
```bash
docker-compose up -d
```

## Environment Variables
The following environment variables are configured in `.env`:
- `DB_DATABASE`: MySQL database name.
- `DB_USERNAME`: MySQL user.
- `DB_PASSWORD`: MySQL password.
- `METEOBLUE_API_KEY`: Your Meteoblue API key.
- `GSM_DEVICE`: Path to the GSM modem (default: `/dev/ttyUSB0`).

## Project Structure
```text
weather-sms-service/
├── bin/                # CLI tools and scripts
├── config/             # Application configuration
├── data/               # Cache, logs, and other data
├── docker/             # Docker configuration
│   └── php/
│       └── Dockerfile
├── public/             # Web server entry point (index.php)
├── src/                # Application source code
│   └── App/            # Main application module
├── test/               # Unit and integration tests
├── .env                # Local environment variables
├── .gitignore
├── docker-compose.yml
└── README.md
```

## Mezzio Skeleton
This project is based on the Mezzio skeleton.

### Development Mode
Enable development mode (disables config caching and enables whoops):
```bash
docker-compose run --rm composer development-enable
```

Disable development mode:
```bash
docker-compose run --rm composer development-disable
```

### Configuration Caching
To clear the configuration cache in production:
```bash
docker-compose run --rm composer clear-config-cache
```

## License
Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
