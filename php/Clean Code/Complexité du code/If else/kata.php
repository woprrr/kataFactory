<?php

function calculateGrade($score) {
    if ($score >= 90) {
        if ($score > 95) {
            return 'A+';
        } else {
            return 'A';
        }
    } else {
        if ($score >= 80) {
            if ($score > 85) {
                return 'B+';
            } else {
                return 'B';
            }
        } else {
            if ($score >= 70) {
                if ($score > 75) {
                    return 'C+';
                } else {
                    return 'C';
                }
            } else {
                return 'F';
            }
        }
    }
}


















































// Dans cet exemple, la fonction calculateGrade prend un score en paramètre et retourne la note correspondante. Cependant, la structure if/else imbriquée crée une indentation excessive et complexifie la lecture du code. Cela rend le code plus difficile à comprendre, à maintenir et à étendre.
