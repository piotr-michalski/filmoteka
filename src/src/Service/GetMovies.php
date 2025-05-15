<?php

declare(strict_types=1);

namespace App\Service;

class GetMovies
{
    private array $movies = [
        'Pulp Fiction',
        'Incepcja',
        'Skazani na Shawshank',
        'Dwunastu gniewnych ludzi',
        'Ojciec chrzestny',
        'Django',
        'Matrix',
        'Leon zawodowiec',
        'Siedem',
        'Nietykalni',
        'Władca Pierścieni: Powrót króla',
        'Fight Club',
        'Forrest Gump',
        'Chłopaki nie płaczą',
        'Gladiator',
        'Człowiek z blizną',
        'Pianista',
        'Doktor Strange',
        'Szeregowiec Ryan',
        'Lot nad kukułczym gniazdem',
        'Wielki Gatsby',
        'Avengers: Wojna bez granic',
        'Życie jest piękne',
        'Pożegnanie z Afryką',
        'Szczęki',
        'Milczenie owiec',
        'Dzień świra',
        'Blade Runner',
        'Labirynt',
        'Król Lew',
        'La La Land',
        'Whiplash',
        'Wyspa tajemnic',
        'Django',
        'American Beauty',
        'Szósty zmysł',
        'Gwiezdne wojny: Nowa nadzieja',
        'Mroczny Rycerz',
        'Władca Pierścieni: Drużyna Pierścienia',
        'Harry Potter i Kamień Filozoficzny',
        'Green Mile',
        'Iniemamocni',
        'Shrek',
        'Mad Max: Na drodze gniewu',
        'Terminator 2: Dzień sądu',
        'Piraci z Karaibów: Klątwa Czarnej Perły',
        'Truman Show',
        'Skazany na bluesa',
        'Infiltracja',
        'Gran Torino',
        'Spotlight',
        'Mroczna wieża',
        'Rocky',
        'Casino Royale',
        'Drive',
        'Piękny umysł',
        'Władca Pierścieni: Dwie wieże',
        'Zielona mila',
        'Requiem dla snu',
        'Forest Gump',
        'Requiem dla snu',
        'Milczenie owiec',
        'Czarnobyl',
        'Breaking Bad',
        'Nędznicy',
        'Seksmisja',
        'Pachnidło',
        'Nagi instynkt',
        'Zjawa',
        'Igrzyska śmierci',
        'Kiler',
        'Siedem dusz',
        'Dzień świra',
        'Upadek',
        'Lśnienie',
        'Pan życia i śmierci',
        'Gladiator',
        'Granica',
        'Hobbit: Niezwykła podróż',
        'Pachnidło: Historia mordercy',
        'Wielki Gatsby',
        'Titanic',
        'Sin City',
        'Przeminęło z wiatrem',
        'Królowa śniegu',
    ];

    /**
     * @param string $filter
     * @return array|string[]
     */
    public function execute(string $filter): array
    {
        return match ($filter) {
            'random' => $this->getRandomRecommendations(),
            'w' => $this->getWMoviesWithEvenLength(),
            'multiword' => $this->getMultiWordTitles(),
            'all' => $this->movies,
            default => [],
        };
    }

    private function getRandomRecommendations(): array
    {
        $uniqueMovies = array_unique($this->movies);
        shuffle($uniqueMovies);

        return array_slice($uniqueMovies, 0, 3);
    }

    private function getWMoviesWithEvenLength(): array
    {
        return array_values(array_filter($this->movies, static function ($title) {
            $titleWithoutSpaces = preg_replace('/\s+/', '', $title);

            return mb_stripos($title, 'W') === 0 && (mb_strlen($titleWithoutSpaces) % 2 === 0);
        }));
    }

    private function getMultiWordTitles(): array
    {
        return array_values(array_filter($this->movies, static function ($title) {
            return str_word_count($title, 0, 'ąćęłńóśźż') > 1;
        }));
    }
}