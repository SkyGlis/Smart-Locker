#include <Adafruit_Keypad.h>
#include <LiquidCrystal_I2C.h>
#include <ArduinoHttpClient.h>
#include <WiFi.h>
#include <Servo.h>
#include "arduino_secrets.h"

#include <SPI.h>
#include <MFRC522.h>

// Config Servo 

#define SERVO A2

Servo s;
int pos;

// Config Keyboard
#define KEYPAD_PID3845

#define R1    3
#define R2    8
#define R3    7
#define R4    5
#define C1    4
#define C2    2
#define C3    6

#include "keypad_config.h"

Adafruit_Keypad teclado = Adafruit_Keypad(makeKeymap(keys), pinosLinha, pinosColunas, tecladoLinha, tecladoColuna);

// Config RFID 

#define SS_PIN 10
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);
// Config LCD
byte charCadeado[8] = {0b01110, 0b10001, 0b10001, 0b11111, 0b11011, 0b11011, 0b11111, 0b00000};
byte charCasa[8] = {0b00000, 0b00000, 0b00100, 0b01110, 0b11111, 0b01010, 0b01010, 0b00000};
byte charSetaEsquerda[8] = {0b00000, 0b00100, 0b00110, 0b11111, 0b11111, 0b00110, 0b00100, 0b00000};
byte charSetaDireita[8] = {0b00000, 0b00100, 0b01100, 0b11111, 0b11111, 0b01100, 0b00100, 0b00000};
byte charProibido[8] = {0b00000, 0b01110, 0b11111, 0b10001, 0b11111, 0b01110, 0b00000, 0b00000};
byte charVisto[8] = {0b00000, 0b00000, 0b00001, 0b00011, 0b10110, 0b11100, 0b01000, 0b00000};

LiquidCrystal_I2C lcd(0x27, 20, 4);

// Config Wi-Fi
// HttpClient http;

const char ssid[] = SECRET_WIFI_SSID;
const char pass[] = SECRET_WIFI_PASS;

char server[] = "DESKTOP-4C4C621";

WiFiClient client;
HttpClient http = HttpClient(client, server, 80);

int status = WL_IDLE_STATUS;

void lcdMenu(const char *mensagem) {
  lcd.clear();
  
  lcd.setCursor(5,0);
  lcd.print("Smart Lock");

  lcd.setCursor(19, 0);
  lcd.write(0);
  
  lcd.setCursor(0, 0);
  lcd.write(0);

  lcd.setCursor(1,1);

  if(mensagem == "rfid") {
    mensagem = "Insira o cartao";
    lcd.setCursor(2, 1);
  }

  if(mensagem == "password") {
    mensagem = "Insira a password";
  }
  lcd.print(mensagem);

  lcd.setCursor(19, 1);
  lcd.write(3);
  
  lcd.setCursor(0, 1);
  lcd.write(2);
  
  lcd.setCursor(3, 3);
  lcd.print("Daniel e Joao");

  lcd.setCursor(19, 3);
  lcd.write(1);
  
  lcd.setCursor(0, 3);
  lcd.write(1);

  lcd.setCursor(8, 2);
}

void lcdErro(const char *mensagem) {
  lcd.clear();

  lcd.setCursor(8,1);
  lcd.print("Aviso");

  lcd.setCursor(19, 1);
  lcd.write(4);
  
  lcd.setCursor(0, 1);
  lcd.write(4);
  
  lcd.setCursor(1,2);
  lcd.print(mensagem);
}

void lcdSucesso(String nome) {
  lcd.clear();

  lcd.setCursor(6,1);
  lcd.print("Sucesso!");

  lcd.setCursor(19, 1);
  lcd.write(5);
  
  lcd.setCursor(0, 1);
  lcd.write(5);
  
  lcd.setCursor(1,2);
  lcd.print("Bem-vindo, ");
  lcd.print(nome);
}

int i;

void setup() {
  // Serial
  Serial.begin(9600);

  // LCD
  lcd.init();
  lcd.clear();         
  lcd.backlight(); 
  lcd.createChar(0, charCadeado);
  lcd.createChar(1, charCasa);
  lcd.createChar(2, charSetaEsquerda);
  lcd.createChar(3, charSetaDireita);
  lcd.createChar(4, charProibido);
  lcd.createChar(5, charVisto);
  lcdMenu("rfid");

  i = 0;

  // Keypad
  teclado.begin();

  // RFID
  SPI.begin();
  mfrc522.PCD_Init();

  // Servo
  s.attach(SERVO);
  s.write(0);

  // WiFi
  while (!Serial);

  Serial.println("\n[WI-FI] A conectar à rede!");
  while (status != WL_CONNECTED) {
    status = WiFi.begin(ssid, pass);

    delay(500);
    Serial.print(".");
  }

  // print out info about the connection:
  Serial.println("\n[WI-FI] Conectado com sucesso!");
  Serial.print("[WI-FI] Endereço IP: ");
  Serial.println(WiFi.localIP());
  Serial.println("\n[AUTH] Sistema Iniciado com sucesso!\n");
}
/*
Função Loop (Arduino):
- Iniciar o handler do keypad
*/

String password;
String passwordCorreta;
String nome;

bool RFIDRead;

void loop() {
  if(!RFIDRead) {
    // Verificação do RFID
    if (!mfrc522.PICC_IsNewCardPresent()) {
     return;
    }

    if (!mfrc522.PICC_ReadCardSerial()) {
      return;
    }

    String RFID = "";
    byte letter; 

    for (byte a = 0; a < mfrc522.uid.size; a++) {
      RFID.concat(String(mfrc522.uid.uidByte[a] < 0x10 ? "0" : ""));
      RFID.concat(String(mfrc522.uid.uidByte[a], HEX));
    }

    RFID.toUpperCase();

    Serial.println("[RFID] Cartão reconhecido: " + RFID);

    Serial.println("[AUTH] Verificar cartão no MYSQL");

    http.get("/pap/api.php?auth=" + RFID);

    String response = http.responseBody();

    if(response == "0") {
      Serial.println("[DATABASE] Cartão não encontrado\n");

      lcdErro("Cartao invalido!");
      delay(1000);
      lcdMenu("rfid");

      return;
    }

    passwordCorreta = response;

    http.get("/pap/api.php?name=" + RFID);

    nome = http.responseBody();

    Serial.println("[DATABASE] Cartão encontrado");
    Serial.println("[DATABASE] Nome: " + nome);
    Serial.println("[DATABASE] Password: " + response + "\n");

    RFIDRead = true;
    lcdMenu("password");

    Serial.println("[KEYPAD] Keypad Ativado");
  } else {
    // Verificação do Teclado
    teclado.tick();
    while(teclado.available()) {
      keypadEvent evento = teclado.read();

      if(evento.bit.EVENT == KEY_JUST_PRESSED) {
        if(!RFIDRead) {
          return;
        }
        char tecla = evento.bit.KEY;
        Serial.print("[KEYPAD] Tecla pressionada: ");
        Serial.println(tecla);
        
        if(tecla == '#') {
          if(i != 0) {
            password = "";

            Serial.println("[AUTH] Password reiniciada\n");

            lcdErro("Password Cancelada!");
            
            i = 0;
          
            delay(1000);
            lcdMenu("password");
            return;
          } else {
            return;
          }
        }

        if(tecla == '*') {
          password = "";

          Serial.println("[AUTH] Login cancelado\n");
        
          lcdErro("Login Cancelado!");
          
          i = 0;
        
          delay(1000);
          lcdMenu("rfid");
          RFIDRead = false;
          return;
        }

        password += tecla;
        lcd.print("*");
        i++;
      }

      if(i == 4) {
          bool sucesso;
          // Avaliar se a palavra passe inserida é a correta
          if(password == passwordCorreta) {
            Serial.println("\n[AUTH] Autenticado com sucesso!");

            lcdSucesso(nome);

            for(pos = 0; pos < 90; pos++) {
              s.write(pos);
              delay(2);
            }

            Serial.println("[AUTH] Cofre aberto!");

            delay(10000);

            for(pos = 90; pos >= 0; pos--) {
              s.write(pos);
              delay(2);
            }
            sucesso = true;
            Serial.println("[AUTH] Cofre fechado!\n");
          } else {
            Serial.println("\n[AUTH] Palavra-passe errada\n");

            lcdErro("Password Incorreta!");
            delay(2000);

            sucesso = false;
          }

          String contentType = "application/x-www-form-urlencoded";
          String postData = "name=" + nome + "&success=" + (sucesso ? "1" : "0");

          http.post("/pap/api.php", contentType, postData);

          int statusCode = http.responseStatusCode();
          String response = http.responseBody();

          Serial.print("[DATABASE] Guardar logs do login - ");
          Serial.print(statusCode);
          Serial.println();

          Serial.println("[AUTH] Sistema reiniciado\n");

          i = 0;
          password = "";
          RFIDRead = false;
          lcdMenu("rfid");
        }
    }
  }
}