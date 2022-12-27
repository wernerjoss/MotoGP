## TODO Liste:
-   Vorname, (Name) anzeigen, wenn Formular aktiv (index.php)   -   erl. 23.04.22
-   Formular ausblenden, wenn Deadline vergangen UND noch keine Ergebnisse eingetragen für aktuelles Rennen -   erl. 20.04.22
-   Punktevergabe fehlt noch komplett, ebenso Auswertung/Anzeige    -   erl. 23.04.22
-   Prüfung der Starnummerneingabe (Nummern zulässig ?) (geht auch ohne, falsche Startnr ergibt keine Punkte :-)    -   erl. 23.04.22
-   Hauptmenü (Anleitung, Fahrerliste...)   -   erl. 20.04.22
-   Zugang Admin Funktionen nur für UID = 1 - erl. mit md5 Hash des Superuser-Nick 25.04.22
-   ggf. md5 Hash Superuser-Nick in config.php speichern    -   nein
-   Anzeige volle Teilnehmer Namen wenn Aufruf via gültigem Nick    -   erl. 26.04.22
-   Nick merken via Session ? (Cookie)  -   erl. 28.04.22
-   Kommentarfunktion für das letzte Rennen ? - erl. 04.05.22
-   Kommentaranzeige f. gewähltes Rennen oder für alle (Liste) - erstmal für alle bisherigen 05.05.22

-   Optional Bonuspunkte für Späteinsteiger ?   -   nein
-   Kommentare möglich bis 2 Tage vor dem folgenden GP (momentan bis 5 Tage nach letztem GP)
-   Jahres/Saison-Kennung für Events, Fahrer, Tips, Jahres-Historie ?
-   später ggf. Fahrerauswahl P1..P3 als Dropdown-Liste - nein
-   ggf. echtes User-Login statt primitivem nick=XYZ Mechanismus :-) - nein

## Handling Sprintrennen ab 2023:
Ab 2023 gibt es jeweils am Samstag ein Sprintrennen mit reduzierter Rundenanzahl und halben Punkten,
dies muss auch irgendwie im Tipspiel berücksichtigt werden.  
Also z.B. 2 Punkte für einen richtigen Tip im Hauptrennen, aber nur einen Punkt im Sprintrennen, jeweils P1 bis P3.  
relativ einfach zu realisieren auf Basis einer Liste der Rennen, mit einer Kennung für Sprint.  
Schwieriger ist das Handling der Tips für ein Rennwochenende:  
Mit der aktuellen Logik ist dann jeweils die Tipabgabe für das Hauptrennen erst dann möglich, wenn der Sprint beendet ist, UND das Ergebnis
eingetragen wurde.  
An sich kein Problem, ABER ich muss dann immer für das Sprintrennen zeitnah das Ergebnis eintragen !  
Alternative:  
Tipabgabe für das folgende Rennen (Sprint oder Main) ist immer 1 Stunde nach Ende des vorherigen möglich, auch wenn dessen Ergebnis noch nicht eingetragen ist.  
Problem dann aber ggf. Verzögerungen durch Wetter, Unfälle, etc...  
Eine weitere Variante wäre die Möglichkeit, die Tips für Sprint- und Hauptrennen vorab gemeinsam eingeben zu können,
hier müsste dann aber sichergestellt werden, dass Tips für das Sprintrennen nur bis zu dessen Deadline möglich sind, Hauptrennen entsprechend.  

