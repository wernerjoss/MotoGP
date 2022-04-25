## Dies ist ein Tipspiel für MotoGP Rennen.
Es ist eine Web-App und erfordert einen Webspace mit PHP und Mysql - 
dies ist freie Software, der Quellcode wird auf <a href="https://github.com/wernerjoss/MotoGP" target="_blank">GitHub</a> gehostet.  
Teilnehmer können immer für das nächste anstehende Rennen Tips für die ersten 3 Plätze abgeben, jeder richtige Tip ergibt einen Punkt,   
also maximal 3 Punkte / Rennen. Die High-Score Liste (Gesamtpunktestand) wird laufend aktualisiert.  
Die Tipabgabe ist möglich bis zur jeweiligen Deadline, diese ist in der Regel kurz nach dem Ende des Warmup:  
![](./assets/img/ksnip_20220424-092122.png)

Um die Eingabe der Tips so einfach wie möglich zu gestalten, und dennoch eine gewisse Sicherheit gegen Missbrauch zu
erreichen, wurde bewusst auf den bekannten User/Passwort Login Dialog verzichtet.  
Stattdessen erhält jeder User einen personalisierten Link zum Login Formular, wodurch sichergestellt wird dass

- Die Eingabedaten eindeutig richtig zugeordnet werden.</li>
- Die Sicherheit gegen Missbrauch solange gewährleistet ist wie der User den Link nicht weitergibt.</li>
- Die Teilnahme sehr erleichtert wird, da keine User/Passwort Kombination gemerkt oder gespeichert werden muss.</li>
  
Das Spiel ist momentan durchgehend an den Startnummern der GP Fahrer orientiert, d.h. sowohl die Eingabe der Tips als auch die
Anzeige der Ergebnisse erfolgt mit Startnummern.  
Zur einfacheren Zuordnung ist auf jeder Seite des Spiels die Liste der Fahrernamen mit zug. Startnummer verlinkt.  
Das Formular zur Tip-Eingabe zeigt immer den nächsten, nicht abgeschlossenen GP an.  
Sobald dieser beendet ist, wird das Rennergebnis (P1 bis P3) vom Admin eingetragen und dann sofort automatisch die Punktetabelle
berechnet und angezeigt, ebenso der Gesamtpunktestand.  
Ab diesem Zeitpunkt wird wieder der nächste GP angezeigt und die Tipeingabe dafür geöffnet.  
Tips können bis zur Deadline (diese wird mit angezeigt) beliebig oft upgedatet bzw. korrigiert werden.  
Nach der Deadline verschwindet das Eingabeformular bis zum Rennende (s.o.).</p>
