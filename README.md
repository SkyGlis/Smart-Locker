# Smart-Locker

## Site
- Programas / Serviços necessários

| Programa | Motivo |
|---|---|
| Visual Studio Code | Mostrar o código |
| WAMP | Dar host no site |
| Arduino IDE | Mostrar o Arduino |

## Arduino
- Librarias

| Libraria | Motivo |
|---|---|
| Adafruit_Keypad | Keypad |
| LiquidCrystal_I2C | LCD |
| ArduinoHttpClient | Requests HTTP |
| WiFi | Conectar a uma LAN |
| Servo | Motor Servo |
| SPI | Comunicar com portas Serial | 
| MFRC522 | RFID |

## MySQL

- Logs:
```SQL
CREATE TABLE logs (
    id int NOT NULL AUTO_INCREMENT,
    user varchar(255),
    date DATETIME,
    success Boolean,
    PRIMARY KEY(id)
)
```

- Users:
```SQL
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    tag varchar(255),
    password varchar(255),
    admin Boolean,
    PRIMARY KEY(id)
)
```
