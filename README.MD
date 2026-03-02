# 🛒 Mikronika Partner Portál (B2B)

Egyedi fejlesztésű, könnyűszerkezetes (lightweight) webes portál elektronikai alkatrészek készletkezelésére és partnerek kiszolgálására. A projekt célja egy gyors, SQL-szerver nélküli (JSON-based) adminisztrációs felület létrehozása volt, amely kompatibilis a hagyományos tárhelyekkel is.

## 🚀 Főbb Funkciók

* **Kétszintű Jogosultságkezelés:**
    * 🔴 **Adminisztrátor:** Teljes hozzáférés. Termékek árának és készletének valós idejű módosítása, új termékek felvitele.
    * 🔵 **Partner (Viewer):** Korlátozott nézet. Csak az aktuális árlista megtekintése és letöltése engedélyezett.
* **Dinamikus Adatkezelés (NoSQL):** Natív PHP backend kezeli a `json` alapú adatbázist (CRUD műveletek).
* **Excel Export:** Az aktuális készlet és árak exportálása `.csv` formátumban egy kattintással.
* **Biztonság:**
    * Bemeneti adatok szűrése (Input Sanitization).
    * Session alapú hitelesítés.
    * `.htaccess` védelem az adatfájlokon (közvetlen letöltés tiltása).

## 🛠️ Technológiai Stack

* **Frontend:** HTML5, CSS3 (Responsive), JavaScript (Fetch API - AJAX)
* **Backend:** Native PHP (Verziófüggetlen, Framework-free)
* **Adattárolás:** JSON (Flat-file database)
* **Környezet:** Apache Web Server (Shared Hosting optimalizált)

## 📂 Telepítés és Futtatás

Mivel a rendszer nem igényel SQL adatbázis telepítést, a beüzemelés azonnali:

1.  Klónozd le a repót:
    ```bash
    git clone [https://github.com/Norisz/mikronika-partner-portal.git](https://github.com/Norisz/mikronika-partner-portal.git)
    ```
2.  Másold a fájlokat egy PHP-t támogató webszerverre (pl. XAMPP `htdocs` mappája vagy éles FTP tárhely).
3.  Nyisd meg a böngészőben a `public/admin.html` oldalt.

### 🔐 Demo Belépési Adatok
*(A GitHub verzió ezeket a biztonságos tesztadatokat tartalmazza)*

| Szerepkör | Felhasználónév | Jelszó |
| :--- | :--- | :--- |
| **Adminisztrátor** | `admin` | `demo_password` |
| **Partner (Néző)** | `partner` | `demo_password` |

---
*A projekt oktatási és demonstrációs céllal készült.*
