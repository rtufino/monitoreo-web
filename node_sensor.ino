#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Credenciales de la WiFi
const char *ssid = "lisoft";
const char *password = "1718641090001";

// Dirección del servidor y la pagina php
const char *servidor = "http://192.168.100.34/ambiental/esp-data.php";

void setup() {
  // put your setup code here, to run once:
  pinMode(13, OUTPUT);
  // Puerto serial
  Serial.begin(9600);
  // Conectarse a la Wifi
  Serial.println("Conectando a la WiFi...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    digitalWrite(13, HIGH);
    delay(250);
    digitalWrite(13, LOW);
    delay(250);
  }
  Serial.println("");
  Serial.println("WiFi Conectado!");
  // Obtiene la direccion IP del Node e imprime
  Serial.print("Dirección IP: ");
  Serial.println(WiFi.localIP());
}


float mapfloat(long x, long in_min, long in_max, float out_min, float out_max) {
  return (float)(x - in_min) * (out_max - out_min) / (float)(in_max - in_min) + out_min;
}


void loop() {
  // Led sentinela
  digitalWrite(13, HIGH);
  delay(500);
  digitalWrite(13, LOW);
  delay(500);
  // Leer entrada analógica
  int sensor = analogRead(A0);
  // Cambiar la lectura analógica a valor de temperatura
  float temperatura = mapfloat(sensor, 0, 1023, 0, 30);
  // Verificar que tiene WiFi
  if (WiFi.status() == WL_CONNECTED){
    // Crear objeto HTTPClient (Cliente http)
    HTTPClient http;

    // Iniciar comunicación con el servidor
    http.begin(servidor);

    // Crear la cabecera http
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Preparar los datos de la peticion
    String parametros = "hum=" + String(temperatura) +
                        "&temp=" + String(temperatura) +
                        "&code=5447eb73757c3c007d675ee1d79d2762";
    Serial.print("Request data: ");
    Serial.println(parametros);

    // Enviar la petición POST con parametros
    int estado = http.POST(parametros);

    if (estado > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(estado);
    }else {
      Serial.print("Error al conectarse: ");
      Serial.println(estado);
    }
    
  } else {
    Serial.println("WiFi desconectado!");
  }

  delay(3000);
}
