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
                <a href="/partenaires-par catégorie">Partenaires par catégorie</a>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>
                    
                    <!-- insert table here -->

                    @foreach ($partnersByInitials as $initial => $partners)
                        <div>
                            <h3>{{ $initial }}</h3>

                            <ul class="partner-list__sublist">
                            @each ('public.partners.partner-list-item', $partners, 'partner')
                            </ul>
                        </div>
                    @endforeach
                </p>
            </dd>

        </dl>
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
</ul>    </div>

<div>        <h3>Artisanat</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/boudoir-de-jeanne">Boudoir de Jeanne</a></li>
<li class="partner-list__entry"><a href="/partenaires/le-carre-noir">Carré Noir (le)</a></li>
<li class="partner-list__entry"><a href="/partenaires/boulangerie-chez-dolcis">Chez Dolci’s (boulangeri  </a></li>
<li class="partner-list__entry"><a href="/partenaires/li-botike-di-lidje">Li Botike di Lidje</a></li>
<li class="partner-list__entry"><a href="/partenaires/o-liste">O-liste</a></li>
<li class="partner-list__entry"><a href="/partenaires/un-pain-cest-tout">Un pain cest tout</a></li>  
<li class="partner-list__entry"><a href="/partenaires/restore-design">REStore Design</a></li>
<li class="partner-list__entry"><a href="/partenaires/restore-dom">Restore DOM</a></li>     
<li class="partner-list__entry"><a href="/partenaires/wattitude">Wattitude</a></li>
<li class="partner-list__entry"><a href="/partenaires/wattitude-kids">Wattitude kids</a></li>        
<li class="partner-list__entry"><a href="/partenaires/pistache-chocolat">Pistache &amp; Chocolat</a></li>
</ul>    </div>
<div>        <h3>Bien-Etre / Santé / Beauté</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/cwillems-haptonomie">Perle Haptonomie</a></li>
<li class="partner-list__entry"><a href="/partenaires/linstant-precieux">Instant précieux</a></li>    
<li class="partner-list__entry"><a href="/partenaires/jerome-lesage">Jérôme Lesage - Psycholoamp;e</a></li>
<li class="partner-list__entry"><a href="/partenaires/savoir-etre">Savoir Etre - Institut dchothérapie</li>
<li class="partner-list__entry"><a href="/partenaires/la-pharmacie-doutremeuse">Pharmacie d&#039;Outremela)</a></li>
<li class="partner-list__entry"><a href="/partenaires/pharmacie-molinvaux">Pharmacie Molinvaux</a></li>
<li class="partner-list__entry"><a href="/partenaires/philippe-bodson">Philippe Bodson</a></li>
<li class="partner-list__entry"><a href="/partenaires/sips">SIPS</a></li>
</ul>    </div>
<div>        <h3>Bars / Cafés / Restaurants</h3>
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
</ul>    </div>
<div>        <h3>Culture / Librairies / Cinéma</h3>
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
</ul>    </div>
       <h3>Décoration / Jardin / Fleurs</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/arqontanprin">Arqontanporin - Dominica   </a></li>
<li class="partner-list__entry"><a href="/partenaires/arqontanporin">Arqontanporin - Neuvice</a></li>
<li class="partner-list__entry"><a href="/partenaires/decovertes-by-cilou">Déco&#039y Cilou</a></li>
<li class="partner-list__entry"><a href="/partenaires/little-store-liege">Little Store Liège</a></li>
</ul>    </div>
<!--div>        <h3>Informatique et Bureautique</h3>
        <ul class="partner-list__sublist">


</ul>    </div-->
<div>        <h3>Habillement / Chaussures / Bijoux</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/le-chapeau-dor">Chapeau d&#039;Or (le)</a></li>
<li class="partner-list__entry"><a href="/partenaires/odette-artisan-bijoutier">Odette Artisan Bijoutier</a></li>
<li class="partner-list__entry"><a href="/partenaires/oxfam-magasins-du-monde-liege">Oxfam (magasins du mondege)</a></li>        </ul>    </div>
<li class="partner-list__entry"><a href="/partenaires/bijouterie-lara-malherbe">Lara Malherbe (bijouterie)  </a></li>
<li class="partner-list__entry"><a href="/partenaires/lellou">Lellou</a></li>
<li class="partner-list__entry"><a href="/partenaires/titake-creation-a-vos-mesures">Titake, Création à vos ms</a></li>


<!--div>        <h3>Hébergement</h3>
        <ul class="partner-list__sublist">
    </ul>
            </div-->
<div>
                <h3>Loisirs / Sport</h3>

                <ul class="partner-list__sublist">
<li class="partner-list__entry"><a href="/partenaires/atelier-de-la-voix">Atelier de la Voix</a></li>
<li class="partner-list__entry"><a href="/partenaires/atelier-de-lutherie-renzo-salvador">Renzo Salvador de lutherie)</a></li>
<li class="partner-list__entry"><a href="/partenaires/lolifant">Lolifant</a></li>
<li class="partner-list__entry"><a href="/partenaires/la-cyclerie">La Cyclerie</a></li>
<li class="partner-list__entry"><a href="/partenaires/la-parenthese">Parenthèse - Liège (La)</a></li>

                </ul>
            </div>
<div>
                <h3>Producteur / Agriculture</h3>

                <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/les-vins-de-ludo">Les Vins de Ludo</a></li>
<li class="partner-list__entry"><a href="/partenaires/les-vintrepides">Les Vintrépides</a></li>
<li class="partner-list__entry"><a href="/partenaires/olivo-de-la-abuela">Olivo de la Abuela</a></li>
<li class="partner-list__entry"><a href="/partenaires/vive-le-vin">Vive le vin</a></li>

                </ul>
            </div>
<div>
                <h3>Construction / Energie / Transport</h3>

                <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/asbl-liege-energie">Liège Énergie (ASBL)</a></li>
      </ul>    </div>
<div>        <h3>Communication / Evenements / Imrimerie</h3>
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
 </ul>    </div>

<!--div>        <h3>Conseil / Formation / Ressources Humaines</h3>
        <ul class="partner-list__sublist"-->


<div>        <h3>Gestion / Finances / Comtabilité</h3>
        <ul class="partner-list__sublist">
<li class="partner-list__entry"><a href="/partenaires/graines-de-compta">Graines de compta</a></li>
<li class="partner-list__entry"><a href="/partenaires/fiduciaire-du-tilleul">Fiduciaire du Tilleul</a></li>        

</ul>    </div>
<div>        <h3>Immobilier / Architecture</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/giga-architectures">Giga architectures</a></li>
</ul> </div>
<div> <h3>Services</h3>
        <ul class="partner-list__sublist">

<li class="partner-list__entry"><a href="/partenaires/pro-velo">Pro Vélo</a></li>
<li class="partner-list__entry"><a href="/partenaires/helmo-campus-guillemins">HELMo, campus Guillemins</a></li> 
<li class="partner-list__entry"><a href="/partenaires/step-conseil-asbl">Step entreprendre</a></li>        
<li class="partner-list__entry"><a href="/partenaires/simon-studio-graphique">Simon Studio Graphique</a></li>
<li class="partner-list__entry"><a href="/partenaires/rayon-9">Rayon 9</a></li>
<li class="partner-list__entry"><a href="/partenaires/les-reines-de-liege">Reines de Liège (Les)</a></li>
<li class="partner-list__entry"><a href="/partenaires/relab-etnikart-asbl">RElab</a></li>   
</ul></div>


        <p class="additional-paragraph">Notez que certains professionnels acceptant le Val’heureux ne sont pas indiqués sur notre site, en général par obligation déontologique ou légale envers la publicité (médecins, etc.).</p>
    </div>
@endsection
