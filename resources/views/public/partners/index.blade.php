@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')
    <div class="partner-list">

        <h2 class="partner-list-main-heading">Où dépenser les Val’heureux ?</h2>

        <dl class="list-of-sections">
            <dt class="list-of-sections__section-name">
                <a href="/carte">Carte des commerces</a>
                <div class="badge badge--new">
                    <span class="badge__hidden-text">(</span>
                    nouveau
                    <span class="badge__hidden-text">)</span>
                </div>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>Cette carte interactive répertorie les commerces, comptoirs de change et autres lieux où vous pouvez obtenir et utiliser des val’heureux. C’est un bon moyen de trouver visuellement ceux qui sont proches de chez vous.</p>
            </dd>
            <dt class="list-of-sections__section-name">
                <a href="/partenaires/localites">Liste des villes et villages</a>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>La liste des {{ $cityCount }} villes et villages où l’on peut utiliser le Val’heureux, triés par ordre alphabétique. Idéal pour trouver d’un coup tous les commerces d’une localité en particulier.</p>
            </dd>
            <dt class="list-of-sections__section-name">
                <a href="/partenaires-sans-adresse-precise">Partenaires sans adresse fixe</a>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>Un certain nombre de professionnels n’apparaissent ni sur la carte, ni dans les listes par localité. C’est généralement parce qu’ils ne travaillent pas à une adresse fixe (services ou travaux à domicile, arts du spectacle, etc.). Vous pouvez retouver ces partenaires ici.</p>
            </dd>
            <dt class="list-of-sections__section-name">
                Partenaires par catégorie
            </dt>
            <dd class="list-of-sections__section-description">
                <h3>Alimentation saine</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/albinete">Al&#039;binète</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/an-vert">An Vert (L&#039;)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-four-et-au-jardin">Au Four et au Jardin</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/lepicerie-du-nord">Epicerie du Nord (l&#039  </a></li>
                    <li class="partner-list__entry"><a href="/partenaires/lentre-pot">Entre-Pot (l&#039;)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/goergettebio">Georgette</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/goveg-vegan-shop">Goveg vegan shop</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/graines-depices">Graines d&#039;épices</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/osons-bio-peuchere">Osons Bio, Peuchère !</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/oufticoop">Oufticoop, supermarché pipatif</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-petits-producteurs">Petits producteurs (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-temps-des-cerises">Temps des Cerises (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-potiquet">Potiquet (Le)</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/vrac-in-box">Vrac in Box</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-fond-des-pans">Au fond des Pans</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-cave-du-fromager">Cave du fromager (la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-table">Table (épicerie fine)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jmc">Oh! Bio &amp; Terroir</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-lessuisse">Comptoir Local</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/justin-mange-bien">Justin mange bien</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-vert-g">Au vert G</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/quels-sont-vos-gouts-boucherie">Quels sont vos goûts ? (boucherie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pub-grain-dorge">Au coin du pub</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maison-hugo-ladry">Maison Hugo Ladry</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/amarres">Amarres</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-ferme-a-larbre-de-liege">Ferme à l&#039;Arbre de Liège (la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-boite-a-vrac">La boîte à vrac</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/li-cortis-des-fawes">Lî Cortis des Fawes</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ambiance-nature">Ambiance Nature</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/legumes-billiau">Billiau (Légumes)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/deux-pois-deux-mesures">Deux pois deux mesures</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bio-dis-moi">Bio Dis-Moi (Saint-Georges)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-cooperative-ardente">Coopérative ardente (la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/petite-gatte-la">Petite Gatte (la)(épicerie, produits locaux)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/demain-lepicerie-zero-dechet">Demain l&#039;épicerie zéro déchet</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/sanoriz">Sanoriz</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/epicerie-fine-et-locale-la-casmate">La Casmate (épicerie fine et locale)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-potagerie-dantan">Potagerie d&#039;Antan</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bio-dis-moi-tihange">Bio Dis-Moi (Tihange)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-tentations-vosgiennes">Tentations vosgiennes (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-topin-en-bourg">Au Top&#039;in en Bourg</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-comptoir-du-naturel">Le comptoir du Naturel</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-idees-en-vrac">Les idées en vrac</a></li>
                </ul>
                <h3>Artisanat</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/boudoir-de-jeanne">Boudoir de Jeanne</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-carre-noir">Carré Noir (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-chez-dolcis">Chez Dolci’s (boulangerie)  </a></li>
                    <li class="partner-list__entry"><a href="/partenaires/li-botike-di-lidje">Li Botike di Lidje</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/o-liste">O-liste</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/un-pain-cest-tout">Un pain cest tout</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/restore-design">REStore Design</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/restore-dom">Restore DOM</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/wattitude">Wattitude</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/wattitude-kids">Wattitude kids</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pistache-chocolat">Pistache &amp; Chocolat</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/oxfam-magasin-du-monde-aywaille">Oxfam (Aywaille)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-chocolaterie-du-haut-clocher">Chocolaterie du Haut Clocher (la)</a></li>  
                    <li class="partner-list__entry"><a href="/partenaires/au-fournil-des-compagnons-boulangerie">Au Fournil des Compagnons Boulangerie</a></li> 
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-ghysens">Boulangerie Ghysens</a></li>  
                    <li class="partner-list__entry"><a href="/partenaires/oxfam-magasin-du-monde-herve">Oxfam magasin du monde Herve</a></li> 
                    <li class="partner-list__entry"><a href="/partenaires/oxfam-magasin-du-monde">Oxfam Magasins du Monde (Huy)</a></li> 
                    <li class="partner-list__entry"><a href="/partenaires/planete-cocon">Planète Cocon</a></li>  
                    <li class="partner-list__entry"><a href="/partenaires/au-plaisir-du-gout">Au Plaisir du Goût</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-burgers">Boulangerie Burgers</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-otten">Boulangerie Otten</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-patisserie-born-christophe">Boulangerie - Patisserie Born Christophe</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-le-chantoir-du-pain">Chantoir du pain (le) (Boulangerie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boucherie-raphael-thonon">Thonon (boucherie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/heid-de-frenay">Heid de Frenay</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boulangerie-patisserie-lessuisse">Lessuisse (boulangerie-pâtisserie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vins-et-elixirs-de-franchimont">Vins et Elixirs de Franchimont (fabrication de vins de fleurs                                                      et bière)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-ble-en-herbe">Blé en herbe (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/magasin-oxfam-verviers">Oxfam - magasins du monde Verviers</a></li>
                </ul>
                <h3>Vins / Alcool / Jus</h3>
                <ul class="partner-list__sublist">
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/divin-bio">Di&#039;Vin Bio</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/plaisir-di-vin-huy">Plaisir Di Vin (Huy)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vins-biobelvin">Biobelvin (vins bio)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/plaisir-di-vin">Plaisir Di Vin (Waremme)</a></li>
                </ul>
                <h3>Bien-Etre / Santé / Beauté</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/cwillems-haptonomie">Perle Haptonomie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/linstant-precieux">Instant précieux</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jerome-lesage">Jérôme Lesage - Psycholoamp;e</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/savoir-etre">Savoir Etre - Institut dchothérapie</li>
                    <li class="partner-list__entry"><a href="/partenaires/la-pharmacie-doutremeuse">Pharmacie d&#039;Outremela)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pharmacie-molinvaux">Pharmacie Molinvaux</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/philippe-bodson">Philippe Bodson</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/sips">SIPS</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/sandrine-bernard">Sandrine Bernard Mieux Etre</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-centre-apaisie-massage-yoga-meditation">Centre Apaisie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/patricia-robert">Patricia Robert (kinésiologue)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-reference-coiffure">La Référence coiffure</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/letre-essentiel">Etre Essentiel (l&#039;)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/reiki-et-bien-etre">Reiki et bien-être</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pharmacie-bia">Pharmacie Bia</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-chemin-du-bien-etre-gestion-des-emotions">Chemin du bien-être (le) (gestion                                                                     des émotions)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/objectif-vision-4130opticiens-michel-bonnesire">Opticiens Michel-Bonnesire (photos,                                                                piles)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pharmacie-naus">Pharmacie Naus</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/que-fhair">Que f&#039;hair (coiffure mixte)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/affleure-de-soie">Affleure de Soie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/coiffure-alice">Coiffure Alice</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/francken-wellness">Franken Wellness</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ma-beaute">Ma Beauté</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/osteopathe-d-o">Ostéopathe D.O. Vinciane Deswysen</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-fil-de-soi-e">Au Fil de Soi-e Massage Grivegnée / Domiciles</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/loree-du-zen">L&#039;Orée du Zen</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maison-medicale-cap-sante">Cap Santé</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/catherine-gerimont">Catherine Gérimont</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/herbe-folle-herboristerie-hutoise">Herbe Folle - Herboristerie hutoise</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/je-suis-zen-fabian-bastianelli">Je suis zen</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pharmacie-pharmavrai">Pharmacie Pharmavrai</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pharmacie-de-lincent-sprl">Pharmacie de Lincent sprl</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/psychologue-isabelle-moreau">Moreau Isabelle (psychologue)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/yvan-thibaut-osteopathe">Yvan Thibaut (ostéopathe)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/savoir-etre-institut-de-psychotherapie">Savoir Etre - Institut de psychothérapie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/coiffure-philosophie">Coiffure Philosophie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/reiki-for-all">Reiki For All</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/coiffure-be-you-be-unique">Be you be unique (coiffure bio et naturelle)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/coiffeur-bio-et-naturel">Bio et Naturel (coiffeur)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/brainzen">Brainzen (M-Ch Botman, formations, coaching, thérapie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/homeopathie-marie-isabelle-wera">Marie</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/mademoiselle-arthur">Mademoiselle Arthur</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-comptoir-dessences">Comptoir d&#039;essences (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-maison-des-plantes">Maison des Plantes</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/salon-de-coiffure-marie-france-pichet">Salon de Coiffure Marie-France Pichet</a></li>
                </ul>
                <h3>Bars / Cafés / Restaurants / Traiteurs</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/babibar">Babibar</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-cuistots">Cuistots (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/dom-gourmandises">Dom Gourmandises</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bistrot-mentin">Bistrot Mentin</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/brasserie-des-coteaux">Brasserie des Coteaux</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-cafeiere">Caféière (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/clos-du-gourmet">Clos du Gourmet</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/como-en-casa">Como en Casa</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/en-ville">En Ville</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ma-ferme-en-ville">Ferme en ville</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/grand-maison">Grand Maison</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/greenburger">Greenburger</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/grifo-artisans-glaciers">Grifo, artisans glaciers</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/asbl-jefar">Jefar ASBL</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/mad-cafe">Mad Café</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/mandibule-en-roue-libre">Mandibule en roue libre</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maxime-renard-table-conviviale">Maxime Renard - Table conviviale</li>
                    <li class="partner-list__entry"><a href="/partenaires/chez-murat">Murat (chez)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-oiseaux-sentetent">Oiseaux s&#039;entêtent</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-petit-carre">Petit Carré (Le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-petit-pressoir">Petit pressoir (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-voisines">Voisines (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/yam-toto">Yam-toto</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-zone">Zone (la)</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/la-cuisine-de-nat-et-pat">La Cuisine de Nat et Pat</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/lempreinte-verte">Empreinte verte (l&#039;)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/chef-sans-toque">Chef sans toque</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/natalia-tella">Restaurant Natalia Tella</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/soeurs-saveur">Sœurs Saveur</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/fra-vino-e-pasta">FRA VINO E PASTA</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/knossos-ii">KNOSSOS II</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/beerlovers-cafe-huy">Beerlover&#039;s Café huy</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-cuisine-de-georgette">La Cuisine de Georgette</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pile-et-face">Pile et Face</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/cerfon-sprl">Brasserie St Georges</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-petits-plats-mijotes">Petits Plats Mijotés</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/friterie-renommee-rocks-schyns">Friterie renommée Rocks Schyns</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/pizzeria-lucio-gusto">Pizzeria Lucio Gusto</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-veranda-brasserie-restaurant">La Véranda (Brasserie Restaurant)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/optimagora">Brasserie Forêt</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-table-mediterraneenne">Table méditerranéenne (la) (restaurant)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/barisat-restaurant-brasserie">Barisart (brasserie-restaurant)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/sandwicherie-fine-a-table">Table (À) (Sandwicherie fine, bar à salade, traiteur)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/au-tournant-gourmand">Tournant gourmand (Au)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/crocespace">Croc&#039;Espace</a></li>
                </ul>
                <h3>Culture / Librairies / Cinéma / Magasin de jouets</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/laquilone">Aquilone</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/centre-culturel-les-chiroux">Chiroux (centre culturel)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/eco-del-nord">Eco Del Nord</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/librairie-entretemps">Entretemps</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/cite-sinvente-la">Cité s&#039;invente (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/livre-aux-tresors">Livre aux Trésors</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/a-la-courte-echelle">Courte Échelle (à la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bouquinerie-michel-garweg">Michel Garweg (bouquinerie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/theatre-de-liege">Théâtre de Liège</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/toutes-directions">Toutes Directions</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-parenthese">Parenthèse - Liège (La)</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/chouette-magique-la"> Chouette Magique (La)</a>  </li>
                    <li class="partner-list__entry"><a href="/partenaires/la-parenthese-embourg">Parenthèse - Embourg (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-derive">Dérive (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-pont-des-arts">Pont des Arts (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/spirales-jeux-et-jouets-liliane-veuchelen">Spirales</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/long-courrier">Long-courrier (librairie ludique)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/folen-jeux">Fol’en jeux</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-traversee-librairie-conseil">La Traversée Librairie conseil</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/fawkes-editions">Fawkes Editions</a></li>
                </ul>
                <h3>Décoration / Mobilier / Jardin / Fleurs </h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/arqontanprin">Arqontanporin - Dominica   </a></li>
                    <li class="partner-list__entry"><a href="/partenaires/arqontanporin">Arqontanporin - Neuvice</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/decovertes-by-cilou">Déco&#039y Cilou</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/little-store-liege">Little Store Liège</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/les-3r">Les 3R - DBAO</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/apiflora">ApiFlora</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maison-seronvalle">Maison Seronvalle</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/freymann-sprl">Freymann SPRL</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ecotopia">Ecotopia (vrac bio, stages, ateliers)</a></li>
                </ul>
                <h3>Habillement / Chaussures / Bijoux</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/le-chapeau-dor">Chapeau d&#039;Or (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/odette-artisan-bijoutier">Odette Artisan Bijoutier</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/oxfam-magasins-du-monde-liege">Oxfam (magasins du mondege)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bijouterie-lara-malherbe">Lara Malherbe (bijouterie)  </a></li>
                    <li class="partner-list__entry"><a href="/partenaires/lellou">Lellou</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/titake-creation-a-vos-mesures">Titake, Création à vos ms</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/maman-moi">Maman &amp; Moi</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vaessen-jean">Vaessen Jean</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/eco-loop">Eco-loop</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/silvern-stone">Silver’n Stone</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/tanagra">Tanagra (bijouterie artisanale)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/cospaia">Cospaïa</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/il-etait-une-fee">Il était une fée</a></li>
                </ul>
                <h3>Loisirs / Atelier / Sport / Tourisme</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/atelier-de-la-voix">Atelier de la Voix</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/atelier-de-lutherie-renzo-salvador">Renzo Salvador de lutherie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/lolifant">Lolifant</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-cyclerie">La Cyclerie</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/the-outsider-ardennes">Outsider Ardennes (the)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-decouvertes-de-comblain">Découvertes de Comblain (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/office-du-tourisme-de-la-commune-de-hamoir">Office du Tourisme Hamoir</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maison-du-tourisme-du-pays-de-herve">Maison du tourisme du Pays de Herve</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/oali">OALI</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/yogastretch-marchin">Yogastretch Marchin</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/un-peu-delan">Un peu d&#039;élan</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jouer-dehors-animation-enfants-en-exterieur">Jouer dehors ! (animation enfants en                                                      extérieur)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/marie-des-arbres">Marie des Arbres (formations fleurs de Bach/gemmothérapie)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/compagnie-de-danse-fabienne-henrot">Fabienne Henrot</a></li>
                </ul>
                <h3>Producteur / Agriculture</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/les-vins-de-ludo">Les Vins de Ludo</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-vintrepides">Les Vintrépides</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/olivo-de-la-abuela">Olivo de la Abuela</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vive-le-vin">Vive le vin</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/les-pres-dhurlevent">Prés d&#039;Hurlevent</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-loge-aux-chevres">Loge aux chèvres  (la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-herve-du-vieux-moulin">Le Herve du Vieux Moulin</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/chevrerie-de-vissoul-la">Chèvrerie de Vissoul (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jardin-de-la-fouarge">Jardin de la Fouarge</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-bergers-de-la-haze">Bergers de la Haze (les) (produits laitiers de brebis)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-jardins-de-fredisa">Jardins de Fredisa (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-bourrache">Bourrache (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/foret-de-luhan">Forêt de Luhan</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vin-de-liege">Vin de Liège</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jardin-dantan">Jardin d&#039;Antan</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/brasserie-grain-dorge">Brasserie Grain d&#039;Orge</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/verger-du-wind">Verger du Wind</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-jardin-du-mont-pointu">Jardin du Mont Pointu (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/boucherie-les-amarelles">Boucherie Les Amarelles</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ferme-de-neubempt">Ferme de Neubempt</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-malices-de-la-ferme-du-vieux-bure">Les Malices de la Ferme du Vieux Bure</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ferme-du-haya-la">Ferme du Haya (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-jardins-du-sart">Jardin du Sart</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ferme-larock">Ferme Larock</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-ferme-blanche">Ferme Blanche (la) (fraises)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/jardins-dorleans-les">Jardins d&#039;Orléans (les)(maraîcher et stages nature)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/le-maraicher-des-ecomines">Maraîcher des Écomines (Le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ferme-du-chemin-des-meuniers">Ferme du chemin des Meuniers</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-bons-plans-de-theo-et-juliet">Les bons plans de Théo et Juliet (maraîchage)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-compagnons-de-la-terre">Compagnons de la Terre (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/vent-de-terre">Vent de terre</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-jardin-delava-francois-humblet">Les Jardins Delava</a></li>
                </ul>
                <h3>Construction / Energie / Transport</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/asbl-liege-energie">Liège Énergie (ASBL)</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/debarsy-carrelages">Debarsy Carrelages</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/biogaz-du-haut-geer-flameco">Biogaz du Haut Geer - Flameco</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/bs-bois-et-services">BS Bois et Services</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/kevers-sa">Kévers Matériaux</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/m3-energie">M3 Energie</a></li>
                </ul>
                <h3>Communication / Evenements / Imprimerie</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/accordart">Accord&#039;Art</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/casa-nicaragua">Casa Nicaragua (la)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/cercle-du-laveu">Cercle du Laveu (le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/barricade">Barricade</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/centre-de-jeunes-et-de-quartier-coque">Bicoque (la, centre de jeunes et de quartier</a> </li>
                    <li class="partner-list__entry"><a href="/partenaires/le-hangar-asbl">Hangar (Le></li>
                    <li class="partner-list__entry"><a href="/partenaires/latitude-jeunes-liege">Latitude Jeunes Liège</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/samy-le-magicien">Samy le magicien</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/office-du-tourisme-de-liege">Office du Tourisme de Liège</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/centre-culturel-de-huy">Centre Culturel de Huy</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/centre-culturel-de-marchin">Centre Culturel de Marchin</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/iddup-atrium">IDDUP Atrium</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/publiciti">Publiciti</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-ferme-au-moulin">Ferme au Moulin (La)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ise-imprimerie">ISE (Imprimerie)</a></li>
                </ul>
                <h3>Gestion / Finances / Comptabilité</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/graines-de-compta">Graines de compta</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/fiduciaire-du-tilleul">Fiduciaire du Tilleul</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/comptabilite-mat-com">Mat-com (comptabilité)</a></li>
                </ul>
                <h3>Gîte / Hotel / Maison de vacances</h3>
                <ul class="partner-list__sublist">
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/gite-hof-luterberg">Hof Luterberg (gîte)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-callune">La Callune (Gîte)</a></li>
                </ul>
                <h3>Immobilier / Architecture</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/giga-architectures">Giga architectures</a></li>
                </ul>
                <h3>Services / Formations</h3>
                <ul class="partner-list__sublist">
                    <li class="partner-list__entry"><a href="/partenaires/pro-velo">Pro Vélo</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/helmo-campus-guillemins">HELMo, campus Guillemins</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/step-conseil-asbl">Step entreprendre</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/simon-studio-graphique">Simon Studio Graphique</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/rayon-9">Rayon 9</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-reines-de-liege">Reines de Liège (Les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/relab-etnikart-asbl">RElab</a></li>
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/le-balthasar-delree-avocats-associes">Balthasar &amp; Delrée Avocats associés</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/greg-bugni-createur-dimages">Greg Bugni, Créateur d&#039;images</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/administration-communale-de-braives">Administration Communale de Braives</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/la-teignouse-asbl-relais-du-terroir">Relais du terroir</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/methodado-by-marie-vandeuren">Méthod&#039;ado by Marie Vandeuren</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/shop-station-habets">Shop Station Habets</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/centre-liegeois-du-beau-mur">Beau-Mur (Le)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/peuple-et-culture-wallonie-bruxelles">Peuple et culture Wallonie-Bruxelles</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/sementiel-coaching-et-formation-martine-rensonnet">Sémentiel</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/probiocide">Probiocide</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/les-fougeres">Fougères (les)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/ferme-de-haute-desnie-lapermaculture-formations">ferme de Haute Desnié (la) (permaculture                                                      formations)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/toilettage-chiens-chats-le-petit-salon">Petit Salon (le)(toilettage chiens-chats)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/maison-dedition-tectis-mata">Tectis Mata (F.Luizi maison d&#039;édition)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/de-bouche-a-oreille-asbl">De Bouche à Oreille ASBL</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/aux-toutous-de-manou">Toutous de Manou (Aux)</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/gp-consult">GP Consult</a></li>
                    <li class="partner-list__entry"><a href="/partenaires/champs-libres">Champs Libres</a></li>
                </ul>
                <h3>Technologies</h3>
                <ul class="partner-list__sublist">
Hors de Liège
                    <li class="partner-list__entry"><a href="/partenaires/jpp-computer">JPP Computer</a></li>
                </ul>
            </dd>
        </dl>
        <p class="additional-paragraph">Notez que certains professionnels acceptant le Val’heureux ne sont pas indiqués sur notre site, en général par obligation déontologique ou légale envers la publicité (médecins, etc.).</p>
    </div>
@endsection
