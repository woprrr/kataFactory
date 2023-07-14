<?php

function calculateGrade($score) {
    switch (true) {
        case $score > 95:
            return 'A+';
        case $score >= 90:
            return 'A';
        case $score > 85:
            return 'B+';
        case $score >= 80:
            return 'B';
        case $score > 75:
            return 'C+';
        case $score >= 70:
            return 'C';
        default:
            return 'F';
    }
}




















// Dans cette version, nous utilisons une structure de cas pour évaluer chaque condition séparément. Cela permet de réduire l'indentation excessive et rend le code plus clair et plus lisible. Chaque cas est évalué dans l'ordre et la première condition qui correspond est exécutée.
