# Release Notes für Vorkasse

## 2.0.13 (2019-06-27)

### Gefixt

- Ein Javascript-Fehler, der auf der Bestellbestätigungsseite auftreten konnte, wurde behoben.

## 2.0.12 (2019-02-24)

### Geändert

- Die Einstellungen für Lieferländer wurden optimiert.

## 2.0.11 (2018-10-23)

### Gefixt

- Ein eventuell auftretendes Problem beim Bereitstellen des Plugins wurde behoben.

## 2.0.10 (2018-10-04)

### Geändert

- Support Informationen ergänzt

## 2.0.9 (2018-08-07)

### Geändert

- Der Plugin User Guide wurde überarbeitet.

## 2.0.8 (2018-08-06)

### Hinzugefügt

- Weitere Sprachen für die Plugin-UI wurden hinzugefügt.

### Geändert

- Sprachabhängige Texte können nun über das Mehrsprachigkeits-Interface angepasst werden.

## 2.0.5 (2018-07-30)

### Gefixt

- Probleme bei der Anzeige und dem Speichern von Einstellungen der Multimandanten in der Plugin-UI wurden behoben.

## 2.0.4 (2018-06-13)

### Gefixt

- Die Anzeige der Bankdaten auf der Bestellbestätigungsseite wird nicht mehr doppelt dargestellt.

## 2.0.3 (2018-06-07)

### Gefixt

- Die Anzeige der Bankdaten ist nun responsive.

## 2.0.2 (2018-06-06)

### Gefixt

- Ein Problem mit der Anzeige der Bankdaten im Mein-Konto Bereich wurde behoben.

## 2.0.1 (2018-04-05)

### Gefixt

- Es wird nun der korrekte Pfad für die Anzeige des Logos der Zahlungsart verwendet.

## 2.0.0 (2018-03-29)

### Geändert

- Der Plugin-Name wurde von **PrePayment** in **CashInAdvance** geändert. Die Funktionalität ist nicht betroffen.
- Die Bankdaten werden in der Kaufabwicklung und auf der Bestellbestätigungsseite wieder korrekt angezeigt.

## 1.3.2 (2018-01-26)

### Geändert
- User guide erweitert.

## 1.3.1 (2018-01-09)

### Geändert

- Neuer Menüpfad **System&nbsp;» Aufträge&nbsp;» Zahlung » Plugins » Vorkasse**.

## 1.3.0 (2017-11-29)

### Geändert

- Kompabilität zu Ceres 2.0 hergestellt.

## 1.2.4 (2017-11-23)

### Gefixt

- Die Variable `$MethodOfPaymentName` in E-Mail-Vorlagen wird nun sprachabhängig ausgegeben.

## 1.2.3 (2017-17-22)

### Geändert

- Update User guide

## 1.2.2 (2017-10-26)

### Geändert

- Der Einhängepunkt im Systembaum ist nun **System » Aufträge » Zahlung » PrePayment » Vorkasse**.

## 1.2.1 (2017-10-10)

### Hinzugefügt

- Die Auftrags-ID kann direkt im Verwendungszweck angezeigt werden. Dafür muss der Platzhalter **%s** im Textfeld der Plugin-Einstellungen eingegeben werden.

## 1.2.0 (2017-08-31)

### Hinzugefügt

- Die Bankdaten werden in der Kaufabwicklung und auf der Bestellbestätigungsseite direkt angezeigt.

### TODO

- Unter **PrePayment Scripts** muss die Container-Verknüpfung von **Script loader: Register/load JS** auf **Script loader: After scripts loaded** geändert werden.

## 1.1.0 (2017-07-31)

### Hinzugefügt

- Einstellungen für **Infoseite** wurden hinzugefügt.
- Einstellungen für **Beschreibung** wurden hinzugefügt.
- Die Funktionalität **Zahlungsart neu ausführen** wurde hinzugefügt.

### Geändert

- Aufpreise der Zahlungsart wurden entfernt.

## 1.0.4 (2017-07-13)

### Hinzugefügt

- Es wurde eine Methode hinzugefügt, um festzulegen, ob ein Kunde von dieser Zahlungsart auf eine andere wechseln kann.
- Es wurde eine Methode hinzugefügt, um festzulegen, ob ein Kunde von einer anderen Zahlungsart auf diese wechseln kann.

## 1.0.3 (2017-06-26)

### Gefixt

- Es wird nun der korrekte Pfad für die Anzeige des Logos der Zahlungsart verwendet.

## 1.0.2 (2017-03-15)

### Gefixt

- Das CSS der Einstellungen im Backend wurde angepasst, so dass die Einstellungen nun über die ganze Seitenbreite angezeigt werden.

### Bekannte Probleme

- Die Einstellungen für **Aufpreise** haben derzeit noch keine Funktion bei der Preisberechnung in der Kaufabwicklung (Checkout)

## 1.0.1 (2017-03-14)

### Geändert

- Es wird die ID der Zahlungsart "Vorkasse" aus dem System verwendet.

## 1.0.0 (2017-03-10)

### Funktionen

- Zahlungsart **Vorkasse** für plentymarkets Webshops
- Anzeige von Verwendungszweck und Bankdaten auf der Bestellbestätigungsseite
