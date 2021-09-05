<?php
/******************************************
************* Funções Gerais **************
******************************************/

/*
 * Recupera Categorias das Galerias (APP Galeria de Imagens)
 */
function getGalleryCat($Category = null)
{
    $GalleryCat = [
        1 => 'Categoria 1', 
        2 => 'Categoria 2',
        3 => 'Categoria 3',
    ];
    if (!empty($Category)):
        return $GalleryCat[$Category];
    else:
        return $GalleryCat;
    endif;
} 

/*
 * Categoria dos Tutoriais (APP Tutoriais)
 */
function getTutorialCat($Category = null)
{
    $TutorialCat = [
        1 => 'Tutoriais do Site',
        2 => 'Tutoriais do Sistema',
        3 => 'Tutoriais de Configurações',
        4 => 'Outros Tutoriais'
    ];
    if (!empty($Category)):
        return $TutorialCat[$Category];
    else:
        return $TutorialCat;
    endif;
} 

/*
 * Dias da Semana (Geral do Sistema)
 */
function getWeekDays($Days = null)
{
    $WeekDays = [
        1 => 'Segunda-Feira',
        2 => 'Terça-Feira',
        3 => 'Quarta-Feira',
        4 => 'Quinta-Feira',
        5 => 'Sexta-Feira',
        6 => 'Sábado',
        7 => 'Domingo'
    ];
    if (!empty($Days)):
        return $WeekDays[$Days];
    else:
        return $WeekDays;
    endif;
} 

/*
 * Meses do Ano (Geral do Sistema)
 */
function getMonthYear($Month = null)
{
    $MonthYear = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    ];
    if (!empty($Month)):
        return $MonthYear[$Month];
    else:
        return $MonthYear;
    endif;
} 

/*
 * Anos (Geral do Sistema)
 */
function getYear($Year = null)
{
    $Years = [
        1 => '2019',
        2 => '2020',
        3 => '2021',
        4 => '2022',
        5 => '2023',
        6 => '2024',
        7 => '2025'
    ];
    if (!empty($Year)):
        return $Years[$Year];
    else:
        return $Years;
    endif;
}

/*
 * Dias da Semana (Geral do Sistema)
 */
function getHours($Hours = null)
{
    $HoursDay = [
        1 => '6:00',
        2 => '6:30',
        3 => '7:00',
        4 => '7:30',
        5 => '8:00',
        6 => '8:30',
        7 => '9:00',
        8 => '9:30',
        9 => '10:00',
        10 => '10:30',
        11 => '11:00',
        12 => '11:30',
        13 => '12:00',
        14 => '12:30',
        15 => '13:00',
        16 => '13:30',
        17 => '14:00',
        18 => '14:30',
        19 => '15:00',
        20 => '15:30',
        21 => '16:00',
        22 => '16:30',
        23 => '17:00',
        24 => '17:30',
        25 => '18:00',
        26 => '18:30',
        27 => '19:00',
        28 => '19:30',
        29 => '20:00',
        30 => '20:30',
        31 => '21:00',
        32 => '21:30',
        33 => '22:00',
    ];
    if (!empty($Hours)):
        return $HoursDay[$Hours];
    else:
        return $HoursDay;
    endif;
}

/******************************************
 **************** Fitness *****************
 ******************************************/
/*
 * Especialidades dos Treinadores (Cadastro de Treinadores)
 */
function getSpecialtiesTrainees($Specialties = null)
{
    $SpecialtiesTrainees = [
        1 => 'Spinning',
        2 => 'Ioga',
        3 => 'Body Shape',
        4 => 'Jiu-Jitsu',
        5 => 'Muay-Thay'
    ];
    if (!empty($Specialties)):
        return $SpecialtiesTrainees[$Specialties];
    else:
        return $SpecialtiesTrainees;
    endif;
}

/*
* Categoria das Ofertas (Cadastro de Ofertas)
 */
function getOffersCategories($Categories = null)
{
    $OffersCategories = [
        1 => 'Categoria 1',
        2 => 'Categoria 2',
        3 => 'Categoria 3',
        4 => 'Categoria 4'
    ];
    if (!empty($Categories)):
        return $OffersCategories[$Categories];
    else:
        return $OffersCategories;
    endif;
}