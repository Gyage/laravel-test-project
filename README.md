## ERPool Software Kft.
# gyallai-gergely

## Általános webalkalmazás megvalósítása.

A feladat egy általános webalkalmazás létrehozása, ahol a felhasználó be tud jelentkezni, majd termékeket tud rögzíteni.
Továbbá a bejelentkezett felhasználó tud vásárlásokat rögzíteni, a vásárlásba termékeket beválogatni.
A vásárlás véglegesítésekor az alkalmazás kiszámolja a vásárlás értékét, figyelembe véve a mennyiségi kedvezményeket.

# 1. Alap funkcionalitás

- Regisztráció
- Bejelentkezés
- Elfelejtett jelszó
- 2FA
- Profiloldal
- Jelszóváltoztatás

# 2. Bõvített funkcionalitás

- Egyedi dashboard

# 3. Üzleti funkcionalitás

:: Menü

: Termékek

- Új termék
	Név
	Egységár
	3 darabos ár
	5 darabos ár
- Termék módosítása
- Termék törlése - amennyiben a termékbõl még nincs vásárolva -

: Vásárlások

- Új vásárlás
	Termékek hozzáadása, vásárolt mennyiség megadása
- Vásárlás módosítása
- Vásárlás törlése - amennyiben még nincs a vásárlás véglegesítve -
- Vásárlás véglegesítése

# 4. Egységtesztek

: Egységteszt készítése a vásárlások érték számításának tesztelésére.
	
## Elvárt  módszertanok

- MVC
- OOP
- SFC
- Újrahasználható komponens alapú tervezés

## Elvárt technológiák

- Laravel keretrendszer
- Jetstream
- Inertia
- Vue.js
- PostgreSQL

## Elõnyös technológiák

- Quasar komponensek