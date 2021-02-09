#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

//setting jaringan
//const char* ssid = "Tjahja Witono";
const char* ssid = "Bayar Cuyy!!!!";
//const char* password = "19111955";
const char* password = "tanyayangpunya";
const char* host = "192.168.1.8"; //alamat IP Server
StaticJsonDocument<100> doc;
StaticJsonDocument<1000> doc1;

#include "DHT.h"

#define DHTTYPE DHT22
#define DHTPIN 0

const int rainsense= A0;

DHT dht(DHTPIN, DHTTYPE);

//modul l298n dan motor dc
int in1= 12;   //inisial pin input1/in1 masuk pin 13
int in2= 14;   //inisial pin input2/in2 masuk pin 12
int in3= 5;   //inisial pin input3/in3 masuk pin 11
int in4= 4;   //inisial pin input4/in4 masuk pin 10

int motorASpeed = 0; //motor 1
int motorBSpeed = 0; // motor 2
int EnA = 16; //motor 1
int EnB = 13; //motor 2


WiFiClient client;
    
//definisi variabel
float kec_angin;
int stat_hujan;
float suhu;
float kelembaban;
String jendela1, jendela2, posisijendela1, posisijendela2;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);

  pinMode(rainsense, INPUT);
  dht.begin();

  //setting wifi
  WiFi.hostname("Wemos");
  WiFi.begin(ssid, password);

  //cek koneksi
  while(WiFi.status() != WL_CONNECTED)
  {
    //mencoba koneksi
    Serial.print(".");
    delay(500);
  }

  //terkoneksi
  Serial.println("WiFi Connected");
  Serial.println(WiFi.localIP());
}

void loop() {
  String data ="";
  bool parse_json = false;
  angin();
  hujan();
  suhukelembaban();
  if (isnan(kec_angin) || isnan(stat_hujan) || isnan(suhu) || isnan(kelembaban))
  {
  } else 
  {
    //koneksi ke server
    WiFiClient client;
    if(client.connect(host, 80))
    {
      Serial.print("connecting to ");
      Serial.println(host);
      //proses pengiriman data ke server
      String Link;
      HTTPClient http;
      Link = "/jendelaotomatis/Mikrokontroler/ambilData?kec_angin="+String(kec_angin)+"&stat_hujan="+String(stat_hujan)+"&suhu="+String(suhu)+"&kelembaban="+String(kelembaban);
      
      client.print(String("GET ") + Link + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Content-Type: application/json\r\n" + "Connection: close\r\n\r\n");
      // Read all the lines of the reply from server and print them to Serial
      while(client.connected() || client.available()){ // baca karakter 1 per satu untuk dimasukan ke string D sebagai bentuk json nantinya
        if (client.available()){
          char c = client.read();
          if(c == '[') {
            parse_json = true;
          }
          if(parse_json){
            data += c;
          }
        }
      }
      client.stop();
    } else
    {
      Serial.println("Connection Failed");
      client.stop();
      return;
    }

    Serial.println(data);
     //parsing JSON
      if (data != "") {
        DeserializationError error = deserializeJson(doc1, data);
        if (error){
          Serial.print(F("deserializeJson() failed: "));
          Serial.println(error.f_str());
          return;
        }else{ // parsing data success
            jendela1 = doc1[0]["status"].as<String>();
            jendela2 = doc1[1]["status"].as<String>();
            
            Serial.println("Status Jendela 1 : " +jendela1);
            Serial.println("Status Jendela 2 : " +jendela2);
        }
      }else{
        Serial.println("No Data Loaded!");
      }

      //mbuka tutup jendela
      if (jendela1 == "1" && posisijendela1 != "1"){
        digitalWrite(in1,HIGH);
        digitalWrite(in2,LOW);
        posisijendela1 = "1"; 
        Serial.println("Jendela 1 Terbuka");
      }else if (jendela1 == "0"  && posisijendela1 != "0")  {
        digitalWrite(in1,LOW);
        digitalWrite(in2,HIGH);
        posisijendela1= "0";
        Serial.println("Jendela 1 Tertutup");
      }
      if (jendela2 == "1" && posisijendela2 != "1"){
        digitalWrite(in1,HIGH);
        digitalWrite(in2,LOW); 
        posisijendela2 = "1"; 
        Serial.println("Jendela 2 Terbuka");
      }else if (jendela2 == "0" && posisijendela2 != "0")  {
        digitalWrite(in1,LOW);
        digitalWrite(in2,HIGH);
        posisijendela2 = "0";
        Serial.println("Jendela 2 Tertutup");
      }
      delay(2000);
    delay(10000);
  }
}

void hujan()
{
  int rainSenseReading = analogRead(rainsense);
  //Serial.print(rainSenseReading);
  if (rainSenseReading < 700){ //0-1024
    stat_hujan = 1; //hujan
  }
  else if (rainSenseReading > 700) {
    stat_hujan = 0;
  }
}

void suhukelembaban()
{
  float t = dht.readTemperature();
  float h = dht.readHumidity();

  if (isnan(t) || isnan(h)) {
    Serial.println("Failed to read from DHT");
  } else {
    suhu = t;
    kelembaban = h;
  }
}

void angin()
{
  //baca data dari wemos
  String angin = "";
  //selama data tersedia
  while(Serial.available()>0)
  {
    //ambil data serial
    angin += char(Serial.read());
  }

  angin.trim();
  char buf[angin.length()];
  angin.toCharArray(buf,angin.length());
  kec_angin = atof(buf);
}
