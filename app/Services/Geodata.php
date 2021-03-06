<?php

namespace App\Services;

class Geodata
{
    /**
     * An array mapping each city of the province of Liège to its commune.
     *
     * @var array
     */
    public $citiesToCommunes = [
        "Abolens" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Abée" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Acosse" => ["name_fr" => "Wasseiges", "nis_code" => "64075"],
        "Aineffe" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Alleur" => ["name_fr" => "Ans", "nis_code" => "62003"],
        "Amay" => ["name_fr" => "Amay", "nis_code" => "61003"],
        "Amblève" => ["name_fr" => "Amblève", "nis_code" => "63001"],
        "Ambresin" => ["name_fr" => "Wasseiges", "nis_code" => "64075"],
        "Ampsin" => ["name_fr" => "Amay", "nis_code" => "61003"],
        "Andrimont" => ["name_fr" => "Dison", "nis_code" => "63020"],
        "Angleur" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Ans" => ["name_fr" => "Ans", "nis_code" => "62003"],
        "Antheit" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Anthisnes" => ["name_fr" => "Anthisnes", "nis_code" => "61079"],
        "Arbrefontaine" => ["name_fr" => "Lierneux", "nis_code" => "63045"],
        "Argenteau" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Aubel" => ["name_fr" => "Aubel", "nis_code" => "63003"],
        "Avennes" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Avernas-le-Bauduin" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Avin" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Awans" => ["name_fr" => "Awans", "nis_code" => "62006"],
        "Awirs" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Ayeneux" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Aywaille" => ["name_fr" => "Aywaille", "nis_code" => "62009"],
        "Baelen" => ["name_fr" => "Baelen", "nis_code" => "63004"],
        "Barchon" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Bas-Oha" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Basse-Bodeux" => ["name_fr" => "Trois-Ponts", "nis_code" => "63086"],
        "Bassenge" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Battice" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Beaufays" => ["name_fr" => "Chaudfontaine", "nis_code" => "62022"],
        "Bellaire" => ["name_fr" => "Beyne-Heusay", "nis_code" => "62015"],
        "Bellevaux-Ligneuville" => ["name_fr" => "Malmedy", "nis_code" => "63049"],
        "Ben-Ahin" => ["name_fr" => "Huy", "nis_code" => "61031"],
        "Bergilers" => ["name_fr" => "Oreye", "nis_code" => "64056"],
        "Berloz" => ["name_fr" => "Berloz", "nis_code" => "64008"],
        "Berneau" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Bertrée" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Bettincourt" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Bevercé" => ["name_fr" => "Malmedy", "nis_code" => "63049"],
        "Beyne-Heusay" => ["name_fr" => "Beyne-Heusay", "nis_code" => "62015"],
        "Bierset" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Bilstain" => ["name_fr" => "Limbourg", "nis_code" => "63046"],
        "Blehen" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Bleret" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Blégny" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Boirs" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Bois-et-Borsu" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Bolland" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Bombaye" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Boncelles" => ["name_fr" => "Seraing", "nis_code" => "62096"],
        "Borlez" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Bovenistier" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Boëlhe" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Bra" => ["name_fr" => "Lierneux", "nis_code" => "63045"],
        "Braives" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Bressoux" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Bullange" => ["name_fr" => "Bullange", "nis_code" => "63012"],
        "Burdinne" => ["name_fr" => "Burdinne", "nis_code" => "61010"],
        "Burg-Reuland" => ["name_fr" => "Burg-Reuland", "nis_code" => "63087"],
        "Butgenbach" => ["name_fr" => "Butgenbach", "nis_code" => "63013"],
        "Celles" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Chaineux" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Chapon-Seraing" => ["name_fr" => "Verlaine", "nis_code" => "61063"],
        "Charneux" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Chaudfontaine" => ["name_fr" => "Chaudfontaine", "nis_code" => "62022"],
        "Cheratte" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Chevron" => ["name_fr" => "Stoumont", "nis_code" => "63075"],
        "Chokier" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Chênée" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Ciplet" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Clavier" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Clermont" => ["name_fr" => "Thimister-Clermont", "nis_code" => "63089"],
        "Clermont-sous-Huy" => ["name_fr" => "Engis", "nis_code" => "61080"],
        "Comblain-au-Pont" => ["name_fr" => "Comblain-au-Pont", "nis_code" => "62026"],
        "Comblain-Fairon" => ["name_fr" => "Hamoir", "nis_code" => "61024"],
        "Comblain-la-Tour" => ["name_fr" => "Hamoir", "nis_code" => "61024"],
        "Cornesse" => ["name_fr" => "Pepinster", "nis_code" => "63058"],
        "Corswarem" => ["name_fr" => "Berloz", "nis_code" => "64008"],
        "Couthuin" => ["name_fr" => "Héron", "nis_code" => "61028"],
        "Cras-Avernas" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Crehen" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Crisnée" => ["name_fr" => "Crisnée", "nis_code" => "64021"],
        "Crombach" => ["name_fr" => "Saint-Vith", "nis_code" => "63067"],
        "Cérexhe-Heuseux" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Dalhem" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Darion" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Dison" => ["name_fr" => "Dison", "nis_code" => "63020"],
        "Dolembreux" => ["name_fr" => "Sprimont", "nis_code" => "62100"],
        "Donceel" => ["name_fr" => "Donceel", "nis_code" => "64023"],
        "Eben-Emael" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Ehein" => ["name_fr" => "Neupré", "nis_code" => "62121"],
        "Ellemelle" => ["name_fr" => "Ouffet", "nis_code" => "61048"],
        "Elsenborn" => ["name_fr" => "Butgenbach", "nis_code" => "63013"],
        "Embourg" => ["name_fr" => "Chaudfontaine", "nis_code" => "62022"],
        "Engis" => ["name_fr" => "Engis", "nis_code" => "61080"],
        "Ensival" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Ernonheid" => ["name_fr" => "Aywaille", "nis_code" => "62009"],
        "Esneux" => ["name_fr" => "Esneux", "nis_code" => "62032"],
        "Eupen" => ["name_fr" => "Eupen", "nis_code" => "63023"],
        "Evegnée" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Eynatten" => ["name_fr" => "Raeren", "nis_code" => "63061"],
        "Faimes" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Fallais" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Faymonville" => ["name_fr" => "Waimes", "nis_code" => "63080"],
        "Feneur" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Ferrières" => ["name_fr" => "Ferrières", "nis_code" => "61019"],
        "Fexhe-le-Haut-Clocher" => ["name_fr" => "Fexhe-le-Haut-Clocher", "nis_code" => "64025"],
        "Fexhe-Slins" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Filot" => ["name_fr" => "Hamoir", "nis_code" => "61024"],
        "Fize-Fontaine" => ["name_fr" => "Villers-le-Bouillet", "nis_code" => "61068"],
        "Fize-le-Marsal" => ["name_fr" => "Crisnée", "nis_code" => "64021"],
        "Flémalle" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Flémalle-Grande" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Flémalle-Haute" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Fléron" => ["name_fr" => "Fléron", "nis_code" => "62038"],
        "Flône" => ["name_fr" => "Amay", "nis_code" => "61003"],
        "Fooz" => ["name_fr" => "Awans", "nis_code" => "62006"],
        "Forêt" => ["name_fr" => "Trooz", "nis_code" => "62122"],
        "Fosse" => ["name_fr" => "Trois-Ponts", "nis_code" => "63086"],
        "Fraipont" => ["name_fr" => "Trooz", "nis_code" => "62122"],
        "Fraiture" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Francorchamps" => ["name_fr" => "Stavelot", "nis_code" => "63073"],
        "Freloux" => ["name_fr" => "Fexhe-le-Haut-Clocher", "nis_code" => "64025"],
        "Fumal" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Geer" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Gemmenich" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Glain" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Gleixhe" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Glons" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Gomzé-Andoumont" => ["name_fr" => "Sprimont", "nis_code" => "62100"],
        "Goé" => ["name_fr" => "Limbourg", "nis_code" => "63046"],
        "Grand-Axhe" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Grand-Hallet" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Grand-Rechain" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Grandville" => ["name_fr" => "Oreye", "nis_code" => "64056"],
        "Grivegnée" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Grâce-Berleur" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Grâce-Hollogne" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Haccourt" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Hamoir" => ["name_fr" => "Hamoir", "nis_code" => "61024"],
        "Haneffe" => ["name_fr" => "Donceel", "nis_code" => "64023"],
        "Hannut" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Hannêche" => ["name_fr" => "Burdinne", "nis_code" => "61010"],
        "Harzé" => ["name_fr" => "Aywaille", "nis_code" => "62009"],
        "Hauset" => ["name_fr" => "Raeren", "nis_code" => "63061"],
        "Henri-Chapelle" => ["name_fr" => "Welkenraedt", "nis_code" => "63084"],
        "Heppenbach" => ["name_fr" => "Amblève", "nis_code" => "63001"],
        "Hermalle-sous-Argenteau" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Hermalle-sous-Huy" => ["name_fr" => "Engis", "nis_code" => "61080"],
        "Hermée" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Herstal" => ["name_fr" => "Herstal", "nis_code" => "62051"],
        "Herve" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Heure-le-Romain" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Heusy" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Hodeige" => ["name_fr" => "Remicourt", "nis_code" => "64063"],
        "Hody" => ["name_fr" => "Anthisnes", "nis_code" => "61079"],
        "Hognoul" => ["name_fr" => "Awans", "nis_code" => "62006"],
        "Hollogne-aux-Pierres" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Hollogne-sur-Geer" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Hombourg" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Horion-Hozémont" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Housse" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Houtain-Saint-Siméon" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Huccorgne" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Huy" => ["name_fr" => "Huy", "nis_code" => "61031"],
        "Héron" => ["name_fr" => "Héron", "nis_code" => "61028"],
        "Ivoz-Ramet" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Jalhay" => ["name_fr" => "Jalhay", "nis_code" => "63038"],
        "Jehay" => ["name_fr" => "Amay", "nis_code" => "61003"],
        "Jemeppe-sur-Meuse" => ["name_fr" => "Seraing", "nis_code" => "62096"],
        "Jeneffe" => ["name_fr" => "Donceel", "nis_code" => "64023"],
        "Julémont" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Jupille-sur-Meuse" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Juprelle" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Kemexhe" => ["name_fr" => "Crisnée", "nis_code" => "64021"],
        "Kettenis" => ["name_fr" => "Eupen", "nis_code" => "63023"],
        "La Calamine" => ["name_fr" => "La Calamine", "nis_code" => "63040"],
        "La Gleize" => ["name_fr" => "Stoumont", "nis_code" => "63075"],
        "La Reid" => ["name_fr" => "Theux", "nis_code" => "63076"],
        "Lambermont" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Lamine" => ["name_fr" => "Remicourt", "nis_code" => "64063"],
        "Lamontzée" => ["name_fr" => "Burdinne", "nis_code" => "61010"],
        "Lanaye" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Lantin" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Lantremange" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Latinne" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Lavoir" => ["name_fr" => "Héron", "nis_code" => "61028"],
        "Lens-Saint-Remy" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Lens-Saint-Servais" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Lens-sur-Geer" => ["name_fr" => "Oreye", "nis_code" => "64056"],
        "Les Avins" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Les Waleffes" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Lierneux" => ["name_fr" => "Lierneux", "nis_code" => "63045"],
        "Liers" => ["name_fr" => "Herstal", "nis_code" => "62051"],
        "Ligney" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Limbourg" => ["name_fr" => "Limbourg", "nis_code" => "63046"],
        "Limont" => ["name_fr" => "Donceel", "nis_code" => "64023"],
        "Lincent" => ["name_fr" => "Lincent", "nis_code" => "64047"],
        "Lixhe" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Liège" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Lommersweiler" => ["name_fr" => "Saint-Vith", "nis_code" => "63067"],
        "Loncin" => ["name_fr" => "Ans", "nis_code" => "62003"],
        "Lontzen" => ["name_fr" => "Lontzen", "nis_code" => "63048"],
        "Lorcé" => ["name_fr" => "Stoumont", "nis_code" => "63075"],
        "Louveigné" => ["name_fr" => "Sprimont", "nis_code" => "62100"],
        "Magnée" => ["name_fr" => "Fléron", "nis_code" => "62038"],
        "Malmedy" => ["name_fr" => "Malmedy", "nis_code" => "63049"],
        "Manderfeld" => ["name_fr" => "Bullange", "nis_code" => "63012"],
        "Marchin" => ["name_fr" => "Marchin", "nis_code" => "61039"],
        "Marneffe" => ["name_fr" => "Burdinne", "nis_code" => "61010"],
        "Meeffe" => ["name_fr" => "Wasseiges", "nis_code" => "64075"],
        "Melen" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Membach" => ["name_fr" => "Baelen", "nis_code" => "63004"],
        "Merdorp" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Meyerode" => ["name_fr" => "Amblève", "nis_code" => "63001"],
        "Micheroux" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Milmort" => ["name_fr" => "Herstal", "nis_code" => "62051"],
        "Modave" => ["name_fr" => "Modave", "nis_code" => "61041"],
        "Moha" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Momalle" => ["name_fr" => "Remicourt", "nis_code" => "64063"],
        "Mons-lez-Liège" => ["name_fr" => "Flémalle", "nis_code" => "62120"],
        "Montegnée" => ["name_fr" => "Saint-Nicolas", "nis_code" => "62093"],
        "Montzen" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Moresnet" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Mortier" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Mortroux" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Moxhe" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "My" => ["name_fr" => "Ferrières", "nis_code" => "61019"],
        "Nandrin" => ["name_fr" => "Nandrin", "nis_code" => "61043"],
        "Nessonvaux" => ["name_fr" => "Trooz", "nis_code" => "62122"],
        "Neu-Moresnet" => ["name_fr" => "La Calamine", "nis_code" => "63040"],
        "Neufchâteau" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Neupré" => ["name_fr" => "Neupré", "nis_code" => "62121"],
        "Neuville-en-Condroz" => ["name_fr" => "Neupré", "nis_code" => "62121"],
        "Noville" => ["name_fr" => "Fexhe-le-Haut-Clocher", "nis_code" => "64025"],
        "Ocquier" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Odeur" => ["name_fr" => "Crisnée", "nis_code" => "64021"],
        "Oleye" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Olne" => ["name_fr" => "Olne", "nis_code" => "63057"],
        "Omal" => ["name_fr" => "Geer", "nis_code" => "64029"],
        "Ombret" => ["name_fr" => "Amay", "nis_code" => "61003"],
        "Oreye" => ["name_fr" => "Oreye", "nis_code" => "64056"],
        "Oteppe" => ["name_fr" => "Burdinne", "nis_code" => "61010"],
        "Othée" => ["name_fr" => "Awans", "nis_code" => "62006"],
        "Otrange" => ["name_fr" => "Oreye", "nis_code" => "64056"],
        "Ouffet" => ["name_fr" => "Ouffet", "nis_code" => "61048"],
        "Ougrée" => ["name_fr" => "Seraing", "nis_code" => "62096"],
        "Oupeye" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Outrelouxhe" => ["name_fr" => "Modave", "nis_code" => "61041"],
        "Paifve" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Pailhe" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Pellaines" => ["name_fr" => "Lincent", "nis_code" => "64047"],
        "Pepinster" => ["name_fr" => "Pepinster", "nis_code" => "63058"],
        "Petit-Hallet" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Petit-Rechain" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Plainevaux" => ["name_fr" => "Neupré", "nis_code" => "62121"],
        "Plombières" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Polleur" => ["name_fr" => "Theux", "nis_code" => "63076"],
        "Poucet" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Poulseur" => ["name_fr" => "Comblain-au-Pont", "nis_code" => "62026"],
        "Pousset" => ["name_fr" => "Remicourt", "nis_code" => "64063"],
        "Queue-du-Bois" => ["name_fr" => "Beyne-Heusay", "nis_code" => "62015"],
        "Racour" => ["name_fr" => "Lincent", "nis_code" => "64047"],
        "Raeren" => ["name_fr" => "Raeren", "nis_code" => "63061"],
        "Rahier" => ["name_fr" => "Stoumont", "nis_code" => "63075"],
        "Ramelot" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Recht" => ["name_fr" => "Saint-Vith", "nis_code" => "63067"],
        "Remicourt" => ["name_fr" => "Remicourt", "nis_code" => "64063"],
        "Retinne" => ["name_fr" => "Fléron", "nis_code" => "62038"],
        "Reuland" => ["name_fr" => "Burg-Reuland", "nis_code" => "63087"],
        "Richelle" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Robertville" => ["name_fr" => "Waimes", "nis_code" => "63080"],
        "Rocherath" => ["name_fr" => "Bullange", "nis_code" => "63012"],
        "Roclenge-sur-Geer" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Rocourt" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Roloux" => ["name_fr" => "Fexhe-le-Haut-Clocher", "nis_code" => "64025"],
        "Romsée" => ["name_fr" => "Fléron", "nis_code" => "62038"],
        "Rosoux-Crenwick" => ["name_fr" => "Berloz", "nis_code" => "64008"],
        "Rotheux-Rimière" => ["name_fr" => "Neupré", "nis_code" => "62121"],
        "Rouvreux" => ["name_fr" => "Sprimont", "nis_code" => "62100"],
        "Saint-André" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Saint-Georges-sur-Meuse" => ["name_fr" => "Saint-Georges-sur-Meuse", "nis_code" => "64065"],
        "Saint-Nicolas" => ["name_fr" => "Saint-Nicolas", "nis_code" => "62093"],
        "Saint-Remy" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Saint-Séverin" => ["name_fr" => "Nandrin", "nis_code" => "61043"],
        "Saint-Vith" => ["name_fr" => "Saint-Vith", "nis_code" => "63067"],
        "Saive" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Sart-lez-Spa" => ["name_fr" => "Jalhay", "nis_code" => "63038"],
        "Schoenberg" => ["name_fr" => "Saint-Vith", "nis_code" => "63067"],
        "Seny" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Seraing" => ["name_fr" => "Seraing", "nis_code" => "62096"],
        "Seraing-le-Château" => ["name_fr" => "Verlaine", "nis_code" => "61063"],
        "Sippenaeken" => ["name_fr" => "Plombières", "nis_code" => "63088"],
        "Slins" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Soheit-Tinlot" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Soiron" => ["name_fr" => "Pepinster", "nis_code" => "63058"],
        "Sougné-Remouchamps" => ["name_fr" => "Aywaille", "nis_code" => "62009"],
        "Soumagne" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Sourbrodt" => ["name_fr" => "Waimes", "nis_code" => "63080"],
        "Spa" => ["name_fr" => "Spa", "nis_code" => "63072"],
        "Sprimont" => ["name_fr" => "Sprimont", "nis_code" => "62100"],
        "Stavelot" => ["name_fr" => "Stavelot", "nis_code" => "63073"],
        "Stembert" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Stoumont" => ["name_fr" => "Stoumont", "nis_code" => "63075"],
        "Strée-lez-Huy" => ["name_fr" => "Modave", "nis_code" => "61041"],
        "Tavier" => ["name_fr" => "Anthisnes", "nis_code" => "61079"],
        "Terwagne" => ["name_fr" => "Clavier", "nis_code" => "61012"],
        "Theux" => ["name_fr" => "Theux", "nis_code" => "63076"],
        "Thimister" => ["name_fr" => "Thimister-Clermont", "nis_code" => "63089"],
        "Thimister-Clermont" => ["name_fr" => "Thimister-Clermont", "nis_code" => "63089"],
        "Thisnes" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Thommen" => ["name_fr" => "Burg-Reuland", "nis_code" => "63087"],
        "Thys" => ["name_fr" => "Crisnée", "nis_code" => "64021"],
        "Tignée" => ["name_fr" => "Soumagne", "nis_code" => "62099"],
        "Tihange" => ["name_fr" => "Huy", "nis_code" => "61031"],
        "Tilff" => ["name_fr" => "Esneux", "nis_code" => "62032"],
        "Tilleur" => ["name_fr" => "Saint-Nicolas", "nis_code" => "62093"],
        "Tinlot" => ["name_fr" => "Tinlot", "nis_code" => "61081"],
        "Tourinne" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Trembleur" => ["name_fr" => "Blégny", "nis_code" => "62119"],
        "Trognée" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Trois-Ponts" => ["name_fr" => "Trois-Ponts", "nis_code" => "63086"],
        "Trooz" => ["name_fr" => "Trooz", "nis_code" => "62122"],
        "Vaux-et-Borset" => ["name_fr" => "Villers-le-Bouillet", "nis_code" => "61068"],
        "Vaux-sous-Chèvremont" => ["name_fr" => "Chaudfontaine", "nis_code" => "62022"],
        "Velroux" => ["name_fr" => "Grâce-Hollogne", "nis_code" => "62118"],
        "Verlaine" => ["name_fr" => "Verlaine", "nis_code" => "61063"],
        "Verviers" => ["name_fr" => "Verviers", "nis_code" => "63079"],
        "Viemme" => ["name_fr" => "Faimes", "nis_code" => "64076"],
        "Vierset-Barse" => ["name_fr" => "Modave", "nis_code" => "61041"],
        "Vieux-Waleffe" => ["name_fr" => "Villers-le-Bouillet", "nis_code" => "61068"],
        "Vieuxville" => ["name_fr" => "Ferrières", "nis_code" => "61019"],
        "Ville-en-Hesbaye" => ["name_fr" => "Braives", "nis_code" => "64015"],
        "Villers-aux-Tours" => ["name_fr" => "Anthisnes", "nis_code" => "61079"],
        "Villers-l'Evêque" => ["name_fr" => "Awans", "nis_code" => "62006"],
        "Villers-le-Bouillet" => ["name_fr" => "Villers-le-Bouillet", "nis_code" => "61068"],
        "Villers-le-Peuplier" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Villers-le-Temple" => ["name_fr" => "Nandrin", "nis_code" => "61043"],
        "Villers-Saint-Siméon" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Vinalmont" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Visé" => ["name_fr" => "Visé", "nis_code" => "62108"],
        "Vivegnis" => ["name_fr" => "Oupeye", "nis_code" => "62079"],
        "Voroux-Goreux" => ["name_fr" => "Fexhe-le-Haut-Clocher", "nis_code" => "64025"],
        "Voroux-lez-Liers" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Vottem" => ["name_fr" => "Herstal", "nis_code" => "62051"],
        "Vyle-et-Tharoul" => ["name_fr" => "Marchin", "nis_code" => "61039"],
        "Waimes" => ["name_fr" => "Waimes", "nis_code" => "63080"],
        "Walhorn" => ["name_fr" => "Lontzen", "nis_code" => "63048"],
        "Wandre" => ["name_fr" => "Liège", "nis_code" => "62063"],
        "Wanne" => ["name_fr" => "Trois-Ponts", "nis_code" => "63086"],
        "Wansin" => ["name_fr" => "Hannut", "nis_code" => "64034"],
        "Wanze" => ["name_fr" => "Wanze", "nis_code" => "61072"],
        "Waremme" => ["name_fr" => "Waremme", "nis_code" => "64074"],
        "Waret-l'Evêque" => ["name_fr" => "Héron", "nis_code" => "61028"],
        "Warnant-Dreye" => ["name_fr" => "Villers-le-Bouillet", "nis_code" => "61068"],
        "Warsage" => ["name_fr" => "Dalhem", "nis_code" => "62027"],
        "Warzée" => ["name_fr" => "Ouffet", "nis_code" => "61048"],
        "Wasseiges" => ["name_fr" => "Wasseiges", "nis_code" => "64075"],
        "Wegnez" => ["name_fr" => "Pepinster", "nis_code" => "63058"],
        "Welkenraedt" => ["name_fr" => "Welkenraedt", "nis_code" => "63084"],
        "Werbomont" => ["name_fr" => "Ferrières", "nis_code" => "61019"],
        "Wihogne" => ["name_fr" => "Juprelle", "nis_code" => "62060"],
        "Wonck" => ["name_fr" => "Bassenge", "nis_code" => "62011"],
        "Xhendelesse" => ["name_fr" => "Herve", "nis_code" => "63035"],
        "Xhendremael" => ["name_fr" => "Ans", "nis_code" => "62003"],
        "Xhoris" => ["name_fr" => "Ferrières", "nis_code" => "61019"],
        "Yernée-Fraineux" => ["name_fr" => "Nandrin", "nis_code" => "61043"],
    ];

    /**
     * Get the data of the commune of a given city.
     *
     * @param  string  $city
     *
     * @return array|null
     */
    function getCommuneForCity(string $city)
    {
        if (array_key_exists($city, $this->citiesToCommunes)) {
            return $this->citiesToCommunes[$city];
        }
    }

    /**
     * Get the NIS code of the commune of a given city.
     *
     * @param  string  $city
     *
     * @return string|null
     */
    function getCommuneNISCodeForCity(string $city)
    {
        if ($commune = $this->getCommuneForCity($city)) {
            return $commune['nis_code'];
        }
    }
}
