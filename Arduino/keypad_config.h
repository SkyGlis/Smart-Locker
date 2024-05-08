// This file contains predefined setup for various Adafruit Matrix Keypads.
#ifndef __KEYPAD_CONFIG_H__
#define __KEYPAD_CONFIG_H__



#if defined(KEYPAD_PID1824) || defined(KEYPAD_PID3845) || defined(KEYPAD_PID419)
const byte tecladoLinha = 4; // linhas
const byte tecladoColuna = 3; // colunas


// Definir os nomes das teclas do teclado
  char keys[tecladoLinha][tecladoColuna] = {
    {'1', '2', '3'},
    {'4', '5', '6'}, 
    {'7', '8', '9'}, 
    {'*', '0', '#'}
    };


// Definir quais os pinos onde se encontram as entradas das linhas e das colunas
byte pinosLinha[tecladoLinha] = {R1, R2, R3, R4};// define os pinos das linhas do keypad
byte pinosColunas[tecladoColuna] = {C1, C2, C3}; // define os pinos das colunas do keypad
#endif



#endif