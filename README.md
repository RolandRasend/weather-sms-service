# Weather SMS Service

## Overview
The Weather SMS Service is designed for use in areas with fickle cell service availability. In regions where internet connectivity is unavailable but a 2G signal for SMS exists, this service provides critical weather information.
This service will be a website where users can add places to be updated on via SMS, but it will also be an SMS-to-API gateway for getting weather information by texting a phone number.
This project will be hosted online as soon as it is mature enough to provide basic functionality.

Features include:
- Sending weather outlooks for pre-selected locations via SMS.
- Responding to user queries for specific place names via text message (pre-planned or instantly upon request).
- Sending updates on storms or other significant weather events for both pre-planned and ad-hoc places

## Requirements
- Docker and Docker Compose
- Raspberry Pi or similar machine with a USB GSM Hat & SIM Card (at `/dev/ttyUSB0`)
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

## Mezzio Skeleton
This project is based on the Mezzio skeleton.

### Development Mode
Enable development mode (disables config caching):
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
