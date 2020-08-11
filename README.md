# Druzyna

# Informacja

Była to strona jednego z projektu moich znajomych, w którym brałem udział.
Strona była drużyny grajacej w CS, głównie służąca jako portal informacyjny.
Natomiast z perspektywy czasu projekt nie wyszedł.

Jest to mocno haotyczna strona jeśli chodzi o kod, a o panelu już nie wspomnę, pierwszy raz robiłem aż tak zaawansowaną rzecz i wiele rzeczy testowałem po raz pierwszy.
Optymalizacja? Wtedy jeszcze się nie przejmowałem takimi rzeczami więc może nie działać najlepiej.

# Objaśnienie

Jeśli chodzi o foldery, to jest to tak że w "images" były zdjęcia partnerów ale dla ich nie wstawiam.
Include to każdy może się domyśleć.
Folder o nazwie obrazy przechowywał zdjęcia ważne dla strony (takie jak logo, tło, itp.)
W folderze ze skryptami są jak każdy może się domyślić 2 skrypty na przewinanie listy partnerów oraz filmików z youtube,
ale przez pewne problemy których w tamtym czasie nie mogłem rozwiązać przez mój brak wiedzy nie zastosowałem ich finalnie do głównej wersji strony.
Katalogu o nazwie style nie muszę objaśniać, po prostu plik z głównym stylem strony oraz czcionka używana na stronie

UWAGA!!!
Strona nie jest w 100% bezpieczna do publicznego używania, z racji takiej że nie miałem w tamtym momencie ani wiele czasu i pomysłowości,
więc aby dodać nowe konto do logowania zrobiłem w kodzie "obejście" przez które można z łatwością dodać użytkownika wpisując następujące dane logowania: Nazwa "uzytkownik", Hasło "dodaj".
Powinny na stronie pokazać się 2 pola do wpisania loginu i hasła i przycisk, hasło jest bezwzłocznie hashowane po przechwyceniu procedurą POST algorytmem sha256. "Gołe" nie jest nigdzie przechowywane.

# Instalacja

Wystarczy edytować plik "databs.php" w folderze "include" i uzupełnić poprawnymi informacjami. Oczywiście struktura bazy danych jest dostępna w pliku "struktura.sql"
