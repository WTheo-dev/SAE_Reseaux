<?php
include_once "fiche_base.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche_valeur.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<header class="header_page_postco_superadmin">
            <div class="header_text"><img class="logo_page_postco_superadmin"
            src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve">Nom Prénom de l'admin</h2>
            </div>
        </header>
<body class="body_fiche_valeur">

<?php
function valEns($name){
    if (isset($_REQUEST[$name])){
        return $_REQUEST[$name];
    }elseif (isset($_COOKIE[$name])){
        return $_COOKIE[$name];
    }
}
?>

<?php
function formatBox($name){
    echo "<br>";
    echo '<input class="noprint" type="checkbox" id="texte'.$name.'" name="texte'.$name.'" ';
    if (valEns('texte'.$name) == "on"){
        echo "checked";
        echo '/>';
        echo '<label class="noprint" for="texte'.$name.'"> Texte </label>';
    }

    echo '<input class="noprint" type="checkbox" id="icon'.$name.'" name="icon'.$name.'" ';
    if (valEns('icon'.$name) == "on"){echo "checked";
    echo '/>';
    echo '<label class="noprint" for="icon'.$name.'"> Icône </label>';
    }

    echo '<input class="noprint" type="checkbox" id="audio'.$name.'" name="audio'.$name.'" ';
    if (valEns('audio'.$name) == "on") {echo "checked";
        echo '/>';
        echo '<label class="noprint" for="audio'.$name.'"> Audio </label>';
    }
    
}
?>
<form action="fiche_traitement.php" method="post">
<input type="hidden" name="from-fiche-valeur" value="OUI, je suis raciste">

<h2 class="h2-valeur-fiche">Fiche intervention</h2>

    <div class="blockbordure1">
    <p class="configgeneralfichevaleur">Configuration Générale</p>

    <span>Taille texte</span>
    <select id="configTaille" name="configTaille">
    <?php if(isset($_COOKIE['configTaille'])): ?>
        <option><?php echo $_COOKIE['configTaille'] ?></option>
    <?php else: ?>
        <option>-- Choisir une taille --</option>
    <?php endif; ?>
    <option>75%</option>
    <option>100%</option>
    <option>125%</option>
    <option>150%</option>
    <option>175%</option>
    <option>200%</option>
    <option>225%</option>
    <option>250%</option>
    <option>275%</option>
    <option>300%</option>
    </select>

    <br>

    <span>Police texte</span>
    <select id="configPolice" name="configPolice">
    <?php if(isset($_COOKIE['configPolice'])): ?>
        <option><?php echo $_COOKIE['configPolice'] ?></option>
    <?php else: ?>
        <option>-- Choisir une police --</option>
    <?php endif; ?>
    <option>Arial</option>
    <option>Verdana</option>
    </select>
    </div>

    <br>

    <div class="blockbordure1">
    <p class="titrepagevaleur">Intervenant</p>
    <label for="nomIntervenant">Nom de l'intervenant:</label>
    <input class="labelfichevaleur" type="text" disabled name="nomIntervenant"
    value="<?php if (isset($_COOKIE['nomIntervenant'])) { echo $_COOKIE['nomIntervenant']; } ?>">
    <?php formatBox("NomIntervenant"); ?>
    <br>
    <br>

    <label for="prenomIntervenant">Prénom de l'intervenant</label>
    <input class="labelfichevaleur" type="text" disabled  name="prenomIntervenant"
    value="<?php if (isset($_COOKIE['prenomIntervenant'])) { echo $_COOKIE['prenomIntervenant']; } ?>">
    <?php formatBox("PrenomIntervenant"); ?>

    </div>
    <br>

    <div class="blockbordure2">
    <p class="titrepagevaleur">Demandeur</p>

    <label for="nomDemandeur">Nom du demandeur: </label>
    <input class="labelfichevaleur" type="text" disabled name="nomDemandeur"
    value="<?php if (isset($_COOKIE['nomDemandeur'])) { echo $_COOKIE['nomDemandeur']; } ?>">
    <?php formatBox("NomDemandeur"); ?>
    <br>
    <label for="degreeUrgence">Degré d'urgence: </label>
    <input class="labelfichevaleur" type="text" disabled name="degreeUrgence"
       value="<?php if (isset($_COOKIE['degreeUrgence'])) { echo $_COOKIE['degreeUrgence']; } ?>">

    <?php formatBox("DegreeUrgence"); ?>
    <br>
    <label for="dateDemande">Date demande: </label>
    <input  class="labelfichevaleur"type="date" disabled name="dateDemande"
       value="<?php if (isset($_COOKIE['dateDemande'])) { echo $_COOKIE['dateDemande']; } ?>">
    <?php formatBox("DateDemande"); ?>
    <br>
    <label for="localisation">Localisation: </label>
    <input class="labelfichevaleur" type="text" disabled name="localisation"
       value="<?php if (isset($_COOKIE['localisation'])) { echo $_COOKIE['localisation']; } ?>">
    <?php formatBox("Localisation"); ?>
    <br>
    <label for="descDemande">Description demande: </label>
    <?php formatBox("DescDemande"); ?>
    <br>
    <textarea id="descDemance" disabled name="descDemande" rows="5"
       value="<?php if (isset($_COOKIE['descDemande'])) { echo $_COOKIE['descDemande']; } ?>"></textarea>
    <br>
    </div>

<br>

<div class="blockbordure3">
<p class="titrepagevaleur">Intervention</p>
<div class="jsp">
<label for="dateIntervention">Date d'intervention:</label>
<input class="labelfichevaleur"disabled type="date" id="dateIntervention"
name="dateIntervention" value="<?php if (isset($_COOKIE['dateIntervention']))
{ echo $_COOKIE['dateIntervention']; } ?>">
<?php formatBox("DateIntervention"); ?>
</div>

<div class="jsp">
<label for="dureeIntervention">Durée de l'opération:</label>
<select disabled id="dureeIntervention" name="dureeIntervention">
<br><option><?php if (isset($_COOKIE['dureeIntervention'])) { echo $_COOKIE['dureeIntervention']; } ?></option>
<br></select>
<?php formatBox("DureeIntervention"); ?>
</div>
</div>

<br>

<div class="blockbordure4">
<p class="titrepagevaleur">Type de maintenance</p>

<input disabled type="checkbox" name="Améliorative" id="Améliorative"
<?php if(isset($_COOKIE['Améliorative'])){echo "checked";}  ?> />
<label for="Améliorative">Améliorative</label>
<?php formatBox("Améliorative"); ?>
<br>

<input disabled type="checkbox" name="Préventive" id="Préventive"
<?php if(isset($_COOKIE['Préventive'])) {echo "checked";} ?> />
<label for="Préventive">Préventive</label>
<?php formatBox("Préventive"); ?>
<br>

<input disabled type="checkbox" name="Corrective" id="Corrective"
<?php if(isset($_COOKIE['Corrective'])) {echo "checked";} ?> />
<label for="Corrective">Corrective</label>
<?php formatBox("Corrective"); ?>
</div>

<br>


<div class="blockbordure5">
<p class="titrepagevaleur">Nature de l'intervention</p>

<input disabled type="checkbox" name="Aménagement" id="Aménagement"
 <?php if(isset($_COOKIE['Aménagement']))
 {echo "checked";} ?> />
<label for="Aménagement">Aménagement</label>
<?php formatBox("Aménagement"); ?>
<br>

<input disabled type="checkbox" name="Finitions" id="Finitions"
<?php if(isset($_COOKIE['Finitions'])) {echo "checked";} ?> />
<label for="Finitions">Finitions</label>
<?php formatBox("Finitions"); ?>
<br>

<input disabled type="checkbox" name="Installation_sanitaire"
 id="Installation_sanitaire" <?php if(isset($_COOKIE['Installation_sanitaire'])){echo "checked";}  ?> />
<label for="Installation_sanitaire">Installation sanitaire</label>
<?php formatBox("Installation_sanitaire"); ?>
<br>

<input disabled type="checkbox" name="Installation_électrique"
 id="Installation_électrique" <?php if(isset($_COOKIE['Installation_électrique'])){echo "checked";}  ?> />
<label for="Installation_électrique">Installation électrique</label>
<?php formatBox("Installation_électrique"); ?>
</div>

<br>

<div class="blockbordure6">
<p class="titrepagevaleur">Travaux réalisés</p>
<textarea disabled id="travauxRealises" name="travauxRealises" rows="10">
    <?php if (isset($_COOKIE['travauxRealises'])) { echo $_COOKIE['travauxRealises']; } ?></textarea>
</div>

<br>

<div class="blockbordure7">
<p class="titrepagevaleur">Travaux non réalisés</p>
<textarea disabled id="travauxNonRealises" name="travauxNonRealises" rows="10">
    <?php if (isset($_COOKIE['travauxNonRealises'])) { echo $_COOKIE['travauxNonRealises']; } ?></textarea>
<br>
<input disabled type="checkbox" name="Nécessite_un_nouvelle_intervention"
id="Nécessite_un_nouvelle_intervention" <?php if(isset($_COOKIE['Nécessite_un_nouvelle_intervention']))
{echo "checked";} ?> />
<label for="Nécessite_un_nouvelle_intervention">Nécessite une nouvelle intervention</label>
<?php formatBox("Nécessite_un_nouvelle_intervention"); ?>
</div>

<br>


<div class="blockbordure8" id="mat_util">
<p class="titrepagevaleur">Matériaux utilisés</p>
<div id="mat_droit">
<?php
for ($i=0; $i<5; $i++){
    echo '<select disabled id="materiaux'.$i.'" name="materiaux'.$i.'">';
    if(isset($_COOKIE['materiaux'.$i])){
        echo "<option>".$_COOKIE['materiaux'.$i]."</option>";
    }else{
        echo '<option>-- Choisir un matériau --</option>';
    }
    echo "</select>";
}
?>
</div>
<div id="mat_gauche">
<?php
for ($i=5; $i<10; $i++){
    echo '<select disabled id="materiaux'.$i.'" name="materiaux'.$i.'">';
    if(isset($_COOKIE['materiaux'.$i])){
        echo "<option>".$_COOKIE['materiaux'.$i]."</option>";
    }else{
        echo '<option>-- Choisir un matériau --</option>';
    }
    echo "</select>";
}
?>
</div>
</div>

<br>
    
<button class="noprint" type="submit" name="enregister_format">
    <i class="fa fa-floppy-o" aria-hidden="true"></i>
    <span>Enregistrer</span>
</button>

</form>

<button class="noprint" type="submit" name="imprimer" onClick="window.print()">
    <i class="fa fa-print" aria-hidden="true"></i>
    <span>imprimer</span>
</button>

<button class="noprint" name="quitter" onClick="window.location.href = 'index.php';">
    <i class="fa fa-ban" aria-hidden="true"></i>
    <span>quitter</span>
</button>

</body>
</html>
