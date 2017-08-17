# plentymarkets Payment – Vorkasse

Mit diesem Plugin binden Sie die Zahlungsart **Vorkasse** in Ihren Webshop ein.

## Zahlungsart einrichten

Bevor die Zahlungsart in Ihrem Webshop verfügbar ist, müssen Sie Einstellungen in Ihrem plentymarkets Backend vornehmen.

##### Zahlungsart einrichten:

1. Öffnen Sie das Menü **Einstellungen&nbsp;» Aufträge&nbsp;» Vorkasse**.
2. Wählen Sie einen Mandanten.
3. Nehmen Sie die Einstellungen vor. Beachten Sie dazu die Erläuterungen in Tabelle 1.
4. **Speichern** Sie die Einstellungen.

<table>
<caption>Tab. 1: Einstellungen für die Zahlungsart vornehmen</caption>
	<thead>
		<th>
			Einstellung
		</th>
		<th>
			Erläuterung
		</th>
	</thead>
	<tbody>
        <tr>
			<td>
				<b>Sprache</b>
			</td>
			<td>
				Sprache wählen. Die übrigen Einstellungen, z.B. Name, Infoseite etc., werden sprachabhängig gespeichert.
			</td>
		</tr>
        <tr>
			<td>
				<b>Name</b>
			</td>
			<td>
				Die Bezeichnung, die in der Übersicht der Zahlungsarten in der Kaufabwicklung für diese Zahlungsart angezeigt wird.
			</td>
		</tr>
		<!--tr>
			<td>
				<b>Infoseite</b>
			</td>
			<td>
				Als <a href="https://www.plentymarkets.eu/handbuch/payment/bankdaten-verwalten/#2-2"><strong>Information zur Zahlungsart</strong></a> eine Kategorieseite vom Typ <strong>Content</strong> anlegen oder die URL einer Webseite eingeben.
			</td>
		</tr-->
		<tr>
			<td>
				<b>Logo</b>
			</td>
			<td>
			Kein Logo, <strong>Standard-Logo</strong> oder <strong>Logo-URL</strong> wählen.<br /><strong>Standard-Logo:</strong> Das Standard-Logo der Zahlungsart wird in der Kaufabwicklung angezeigt.<br /><strong>Logo-URL:</strong> Eine https-URL, die zum Logo-Bild führt, angeben. Gültige Dateiformate sind .gif, .jpg oder .png. Die Maximalgröße beträgt 190 Pixel in der Breite und 60 Pixel in der Höhe.
			</td>
		</tr>
        <tr>
			<td>
				<b>Aufpreis Inland</b>
			</td>
			<td>
Pauschalen Wert eingeben, der bei Aufträgen berücksichtigt wird, bei denen das Systemland gewählt wurde. Diese Kosten werden im Bestellvorgang bei der Wahl der Zahlungsart zum Auftrag addiert. Der Betrag fließt in die Gesamtsumme des Auftrags ein und wird nicht einzeln ausgewiesen.
		</tr>
		<tr>
			<td>
				<b>Aufpreis Ausland</b>
			</td>
			<td>
Pauschalen Wert eingeben, der bei Aufträgen berücksichtigt wird, bei denen nicht das Systemland gewählt wurde. Diese Kosten werden im Bestellvorgang bei der Wahl der Zahlungsart zum Auftrag addiert. Der Betrag fließt in die Gesamtsumme des Auftrags ein und wird nicht einzeln ausgewiesen.
		</tr>
		<tr>
			<td>
				<b>Lieferländer</b>
			</td>
			<td>
				Nur für die hier eingestellten Lieferländer ist diese Zahlungsart freigegeben.
			</td>
		</tr>
        <tr>
			<td colspan="2" class="th">Anzeigedaten</td>  
		</tr>
		<tr>
			<td>
				<b>Verwendungszweck</b>
			</td>  
			<td>
			Verwendungszweck für die Zahlungsart eingeben.
			</td>
		</tr>
		<tr>
			<td>
				<b>Verwendungszweck anzeigen</b>
			</td>  
			<td>
			Aktivieren, um den Verwendungszweck in der Bestellbestätigung anzuzeigen. Diese Informationen werden dem passenden <a href="#10."><strong>Template-Container</strong></a> verknüpft.
			</td>
		</tr>
		<tr>
			<td>
				<b>Bankdaten anzeigen</b>
			</td>  
			<td>
			Aktivieren, um die Bankdaten in der Bestellbestätigung anzuzeigen. Bankdaten speichern Sie im Menü <strong>Einstellungen » Grundeinstellungen » Bank</strong>.
			</td>
		</tr>
	</tbody>
</table>

## Logo der Zahlungsart auf der Startseite anzeigen

Das Template-Plugin **Ceres** bietet Ihnen auf der Startseite einen Template-Container, in dem Sie die Logos Ihrer Zahlungsart anzeigen können. Gehen Sie wie im Folgenden beschrieben vor, um das Logo der Zahlungsart zu verknüpfen.

##### Logo mit Template-Container verknüpfen:

1. Gehen Sie zu **Plugins » Content**. 
3. Wählen Sie den Bereich **Cash in advance icon**.
4. Aktivieren Sie den Container **Homepage: Payment method container**.
5. **Speichern** Sie die Einstellungen.<br />→ Das Logo der Zahlungsart wird auf der Startseite des Webshops angezeigt.

## Bankdaten in der Bestellbestätigung anzeigen <a id="10." name="10."></a>

Gehen Sie wie im Folgenden beschrieben vor, um die im System hinterlegten Bankdaten und einen Verwendungszweck auf der Bestellbestätigungsseite anzuzeigen.

##### Bankdaten anzeigen:

1. Öffnen Sie das Menü **Einstellungen&nbsp;» Aufträge&nbsp;» Vorkasse**.
2. Wählen Sie einen Mandanten.
3. Geben Sie im Bereich **Anzeigedaten** einen **Verwendungszweck** ein.
4. Aktivieren Sie die Option **Verwendungszweck anzeigen**.
5. Aktivieren Sie die Option **Bankdaten anzeigen**.
4. **Speichern** Sie die Einstellungen.

Nachdem Sie die Einstellungen vorgenommen haben, verknüpfen Sie die Bankdaten mit einem Template-Container.

##### Bankdaten mit Template-Container verknüpfen:

1. Gehen Sie zu **Plugins » Content**. 
3. Wählen Sie den Bereich **Cash in advance bank details**.
4. Aktivieren Sie den Container **Order confirmation: Additional payment information**.
5. **Speichern** Sie die Einstellungen.<br />→ Die Bankdaten werden auf der Bestellbestätigungsseite angezeigt.

## Zahlungsart neu ausführen

Sie können Kunden die Möglichkeit anbieten, diese Zahlungsart erneut auszuführen. Gehen Sie dazu wie im Folgenden beschrieben vor.

##### Zahlungsart neu ausführen:

1. Gehen Sie zu **Plugins » Content**.
2. Gehen Sie zu **PrePayment Reinitialise Payment (PrePayment)**.
3. Aktivieren Sie den Container **My account: Additional payment information**.<br />→ Der Kunde kann in der Auftragshistorie im **Mein-Konto**-Bereich die Zahlung neu ausführen.
4. Aktivieren Sie den Container **Order confirmation: Additional payment information**.<br />→ Der Kunde kann auf der Bestellbestätigungsseite die Zahlung neu ausführen.
2. Gehen Sie zu **PrePayment Reinitialise Payment Script (PrePayment)**.
5. Aktivieren Sie den Container **Script loader: Register/load JS**.
7. **Speichern** Sie die Einstellungen.

Der Kunde kann nun die Zahlungsart in der Auftragshistorie im **Mein-Konto**-Bereich bzw. auf der Bestellbestätigungsseite neu ausführen. Bei Vorkasse bedeutet dies die erneute Anzeige der im Backend hinterlegten Bankinformationen.

## Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-payment-prepayment/blob/master/LICENSE.md).
