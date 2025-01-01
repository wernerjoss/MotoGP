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

- Die Eingabedaten eindeutig richtig zugeordnet werden.
- Die Sicherheit gegen Missbrauch solange gewährleistet ist wie der User den Link nicht weitergibt.
- Die Teilnahme sehr erleichtert wird, da keine User/Passwort Kombination gemerkt oder gespeichert werden muss.
  
Das Spiel ist momentan durchgehend an den Startnummern der GP Fahrer orientiert, d.h. sowohl die Eingabe der Tips als auch die
Anzeige der Ergebnisse erfolgt mit Startnummern.  
Zur einfacheren Zuordnung ist auf jeder Seite des Spiels die Liste der Fahrernamen mit zug. Startnummer verlinkt.  
Das Formular zur Tip-Eingabe zeigt immer den nächsten, nicht abgeschlossenen GP an.  
Sobald dieser beendet ist, wird das Rennergebnis (P1 bis P3) vom Admin eingetragen und dann sofort automatisch die Punktetabelle
berechnet und angezeigt, ebenso der Gesamtpunktestand.  
Ab diesem Zeitpunkt wird wieder der nächste GP angezeigt und die Tipeingabe dafür geöffnet.  
Tips können bis zur Deadline (diese wird mit angezeigt) beliebig oft upgedatet bzw. korrigiert werden.  
Nach der Deadline verschwindet das Eingabeformular bis zum Rennende (s.o.).

## 2023: Sprint Races am Samstag
Ab 2023 gibt es neu an jedem Rennwochendende samstags ein sog. Sprint Race mit halber Punkevergabe und halber Renndistanz des Hauptrennens am Sonntag.  
Siehe auch [TODO.md](./TODO.md).  
Ab Version 0.2.0 werden diese wie folgt behandelt:
- Ein richtiger Tip (P1..P3) im Sprintrennen gibt wie bisher einen Punkt
- Ein richtiger Tip (P1..P3) im Hauptrennen gibt nun 2 Punkte
- die Tipabgabe für das folgende Rennen (Sprint oder Hauptrennen) ist immer 2 Stunden nach Ende der Deadline des vorherigen möglich, auch wenn dessen Ergebnis noch nicht eingetragen ist.
- Dies ist deswegen so, weil das Hauptrennen schon am folgenden Tag stattfindet und ich nicht garantieren kann, dass das Ergebnis des Sprintrennens immer sofort nach dessen Ende eingetragen wird (nach der bisherigen Logik war vor diesem Eintrag keine Tipeingabe für das nächste Rennen möglich)
- 27.03.23: Die Punktevergabe wurde ab Version 0.2.1 wieder auf EINEN Punkt für jeden richtigen Tip geändert :-) - das ist einfach logischer, wenn man schon nicht die Staffelung der WM Wertung (P1=25, P2=20 Punkte usw.) übernimmt.

## 2025: Tip für den WM Endstand
Ab Version 0.3.0 ist **VOR** der Saison ein Tip auf den WM-Endstand möglich - P1 bis P3 wie bei den Rennen.  
Die aktuellen Tips der Teilnehmer werden live angezeigt und können bis zur angezeigten Deadline geändert werden.  
Tips für das erste Rennen sind erst **NACH** dieser Deadline möglich !  
Anmerkung: Die Punktevergabe für den Endstand ist aktuell (12/24) noch nicht festgelegt, ebenso wenig deren möglichen Einfluss auf die Jahresendwertung des Tipspiels.

## Admin Hinweise
Zur Installation des Spiels auf einem Webserver wird eine Mysql Datenbank benötigt, diese muss vorab mit dem Dump im Ordner sql
befüllt werden, alle Tabellen haben das Prefix MGP_.  
Ggf. sind vorher noch die Renn-Termine sowie die Namen und Startnummern der Fahrer anzupassen (der Dump enthält die Daten von 2022).
Die Zugangsdaten zur Datenbank müssen in die Datei include/connect.php eingetragen werden.  
Bevor das Spiel betriebsbereit ist, müssen Teilnehmer (User) angelegt werden, am einfachsten per phpMyAdmin oder im Dump.
Der wichtigste User ist der mit der UID=1, dies ist der Administrator - nur er hat auch Admin Funktionen (Edit Event, Add User) im Hautpmenue !  
Sobald dieser angelegt ist, können mittels admin/adduser.php weitere User bequem angelegt werden, das Feld Passwort ist momentan ein Platzhalter
und kann leer bleiben.  
Angelegte User können dann durch Aufruf der Startseite mit ihrem Nickname als Parameter (URL/?nick=Nickname) am Spiel teilnehmen - der Admin kann zusätzlich zum Anlegen von Usern auch die Events bearbeiten via admin/editevent.php (auch hier muss der Nickname als Parameter übergeben werden).
Diese Funktion wird immer nach dem Zieleinlauf eines Rennens benötigt, zum Eintragen des Renn-Ergebnisses.  
Weitere Admin Funktionen sind aktuell nicht vorgesehen und müssen daher z.B. via phpMyAdmin vorgenommen werden.
