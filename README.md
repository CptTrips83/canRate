# canRate

## Projektbeschreibung
canRate ist eine Webanwendung zur Bewertung von Cannabis-Produkten. Die Plattform ermöglicht es Benutzern, verschiedene Cannabis-Produkte zu entdecken, zu bewerten und Bewertungen anderer Benutzer einzusehen. Die Anwendung bietet auch Informationen über Cannabis-Produzenten.

## Technologien
- **PHP 8.2+**
- **Symfony 7.2**: Framework für die Anwendungsentwicklung
- **Doctrine ORM**: Für die Datenbankinteraktion
- **Twig**: Template-Engine für die Benutzeroberfläche
- **EasyAdmin Bundle**: Für die Administrationsoberfläche
- **Symfony Security Bundle**: Für Authentifizierung und Autorisierung
- **Symfony Forms**: Für die Formularverarbeitung
- **Stimulus**: Für JavaScript-Funktionalitäten
- **MySQL**: Als Datenbanksystem

## Installation

### Voraussetzungen
- PHP 8.2 oder höher
- Composer
- MySQL oder MariaDB
- Symfony CLI (empfohlen)
- Node.js und npm (für Asset-Management)

### Installationsschritte
1. Repository klonen:
   ```
   git clone [repository-url]
   cd canRate
   ```

2. Abhängigkeiten installieren:
   ```
   composer install
   ```

3. Umgebungsvariablen konfigurieren:
   - Kopieren Sie die `.env`-Datei zu `.env.local` und passen Sie die Datenbankkonfiguration an:
     ```
     DATABASE_URL=mysql://username:password@127.0.0.1:3306/canrate?serverVersion=8.0
     ```

4. Datenbank erstellen und Migrationen ausführen:
   ```
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Assets installieren:
   ```
   php bin/console importmap:install
   ```

6. Server starten:
   ```
   symfony server:start
   ```
   oder
   ```
   php -S localhost:8000 -t public/
   ```

## Nutzung
- **Benutzerregistrierung**: Neue Benutzer können sich über die Registrierungsseite anmelden.
- **Produkte durchsuchen**: Benutzer können Cannabis-Produkte durchsuchen und Details einsehen.
- **Bewertungen abgeben**: Angemeldete Benutzer können Bewertungen für Produkte abgeben.
- **Produzenten-Informationen**: Informationen über verschiedene Cannabis-Produzenten sind verfügbar.
- **Admin-Bereich**: Administratoren können Produkte, Produzenten und Benutzer über die Admin-Oberfläche verwalten.

## Projektstruktur
- **src/Controller/**: Enthält die Controller für die verschiedenen Funktionen der Anwendung
- **src/Entity/**: Enthält die Entitätsklassen für das Datenmodell
- **src/Form/**: Enthält die Formularklassen
- **src/Repository/**: Enthält die Repository-Klassen für Datenbankabfragen
- **templates/**: Enthält die Twig-Templates für die Benutzeroberfläche
- **public/**: Enthält öffentlich zugängliche Dateien
- **assets/**: Enthält JavaScript, CSS und Bilder
- **config/**: Enthält Konfigurationsdateien
- **migrations/**: Enthält Datenbankmigrationen

## Tests
Tests können mit PHPUnit ausgeführt werden:
```
php bin/phpunit
```

## Lizenz
Proprietär - Alle Rechte vorbehalten.