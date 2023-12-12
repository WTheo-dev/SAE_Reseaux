<?php
foreach ($_POST as $param => $value){
    //echo $param." : ".$value."<br>";
    setcookie($param, $value, time() + (86400 * 60));
}

foreach ($_COOKIE as $name => $value){
    //echo $name.' : '.$value.'<br>';
    if (str_starts_with($name, "texte") || str_starts_with($name, "icon") || str_starts_with($name, "audio")){
        if (!isset($_POST[$name])){
            unset($_COOKIE[$name]); 
            setcookie($name, '', -1); 
        }
    }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="ficheens.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<body>

<?php
function valEns($name){
    if (isset($_REQUEST[$name])){
        return $_REQUEST[$name];
    }else{
        return $_COOKIE[$name];
    }
}
?>

<?php
function formatBox($name){
    echo "<br>";
    echo '<input class="noprint" type="checkbox" id="texte'.$name.'" name="texte'.$name.'" ';
    if (valEns('texte'.$name) == "on") echo "checked";
    echo '/>';
    echo '<label class="noprint" for="texte'.$name.'">texte</label>';

    echo '<input class="noprint" type="checkbox" id="icon'.$name.'" name="icon'.$name.'" ';
    if (valEns('icon'.$name) == "on") echo "checked";
    echo '/>';
    echo '<label class="noprint" for="icon'.$name.'">icon</label>';

    echo '<input class="noprint" type="checkbox" id="audio'.$name.'" name="audio'.$name.'" ';
    if (valEns('audio'.$name) == "on") echo "checked";
    echo '/>';
    echo '<label class="noprint" for="audio'.$name.'">audio</label>';
}
?>

<form action="fiche_valeur.php" method="post">

<h2>Fiche intervention</h2>

    <div class="block bordure">
    <p>Intervenant</p>

    <label for="nomIntervenant">Nom de l'intervenant</label>
    <input type="text" disabled name="nomIntervenant" value="<?php echo $_COOKIE['nomIntervenant'] ?>">
    <?php formatBox("NomIntervenant", ""); ?>

    <br>

    <label for="prenomIntervenant">Prénom de l'intervenant</label>
    <input type="text" disabled  name="prenomIntervenant" value="<?php echo $_COOKIE['prenomIntervenant'] ?>">
    <?php formatBox("PrenomIntervenant", ""); ?>

    </div>
    <br>

    <div class="block bordure">
    <p>Demandeur</p>

    <label for="nomDemandeur">Nom du demandeur: </label>
    <input type="text" name="nomDemandeur" value="<?php echo valEns('nomDemandeur') ?>"></input>
    <?php formatBox("NomDemandeur"); ?>
    <br>
    <label for="degreeUrgence">Degré d'urgence: </label>
    <input type="text" name="degreeUrgence" value="<?php echo valEns('degreeUrgence') ?>"></input>
    <?php formatBox("DegreeUrgence"); ?>
    <br>
    <label for="dateDemande">Date demande: </label>
    <input type="date" name="dateDemande" value="<?php echo valEns('dateDemande') ?>"></input>
    <?php formatBox("DateDemande"); ?>
    <br>
    <label for="localisation">Localisation: </label>
    <input type="text" name="localisation" value="<?php echo valEns('localisation') ?>"></input>
    <?php formatBox("Localisation"); ?>
    <br>
    <label for="descDemande">Description demande: </label>
    <?php formatBox("DescDemande"); ?>
    <br>
    <textarea id="descDemance" name="descDemande" rows="5"><?php echo valEns('descDemande') ?></textarea>
    <br>
    </div>

<br>

<div class="block bordure">
<p>Intervention</p>

<div class="jsp">
<label for="dateIntervention">Date d'intervention:</label>
<input disabled type="date" id="dateIntervention" name="dateIntervention" value="<?php echo $_COOKIE['dateIntervention']; ?>">
<?php formatBox("DateIntervention", ""); ?>
</div>

<div class="jsp">
<label for="dureeIntervention">Durée de l'opération:</label>
<select disabled id="dureeIntervention" name="dureeIntervention">
<br><option><?php echo $_COOKIE['dureeIntervention']; ?></option>
<br></select>
<?php formatBox("DureeIntervention", ""); ?>
</div>
</div>

<br>

<div class="block bordure">
<p>Type de maintenance</p>

<input disabled type="checkbox" name="Améliorative" id="Améliorative" <?php if(isset($_COOKIE['Améliorative'])) echo "checked"; ?> />
<label for="Améliorative">Améliorative</label>
<?php formatBox("Améliorative", ""); ?>
<br>

<input disabled type="checkbox" name="Préventive" id="Préventive" <?php if(isset($_COOKIE['Préventive'])) echo "checked"; ?> />
<label for="Préventive">Préventive</label>
<?php formatBox("Préventive", ""); ?>
<br>

<input disabled type="checkbox" name="Corrective" id="Corrective" <?php if(isset($_COOKIE['Corrective'])) echo "checked"; ?> />
<label for="Corrective">Corrective</label>
<?php formatBox("Corrective", ""); ?>
</div>

<br>


<div class="block bordure">
<p>Nature de l'intervention</p>

<input disabled type="checkbox" name="Aménagement" id="Aménagement" <?php if(isset($_COOKIE['Aménagement'])) echo "checked"; ?> />
<label for="Aménagement">Aménagement</label>
<?php formatBox("Aménagement", ""); ?>
<br>

<input disabled type="checkbox" name="Finitions" id="Finitions" <?php if(isset($_COOKIE['Finitions'])) echo "checked"; ?> />
<label for="Finitions">Finitions</label>
<?php formatBox("Finitions", ""); ?>
<br>

<input disabled type="checkbox" name="Installation_sanitaire" id="Installation_sanitaire" <?php if(isset($_COOKIE['Installation_sanitaire'])) echo "checked"; ?> />
<label for="Installation_sanitaire">Installation sanitaire</label>
<?php formatBox("Installation_sanitaire", ""); ?>
<br>

<input disabled type="checkbox" name="Installation_électrique" id="Installation_électrique" <?php if(isset($_COOKIE['Installation_électrique'])) echo "checked"; ?> />
<label for="Installation_électrique">Installation électrique</label>
<?php formatBox("Installation_électrique", ""); ?>
</div>

<br>

<div class="block bordure">
<p>Travaux réalisés</p>
<textarea disabled id="travauxRealises" name="travauxRealises" rows="10"><?php echo $_COOKIE['travauxRealises'] ?></textarea>
</div>

<br>

<div class="block bordure">
<p>Travaux non réalisés</p>
<textarea disabled id="travauxNonRealises" name="travauxNonRealises" rows="10"><?php echo $_COOKIE['travauxNonRealises']; ?></textarea>
<br>
<input disabled type="checkbox" name="Nécessite_un_nouvelle_intervention" id="Nécessite_un_nouvelle_intervention" <?php if(isset($_COOKIE['Nécessite_un_nouvelle_intervention'])) echo "checked"; ?> />
<label for="Nécessite_un_nouvelle_intervention">Nécessite un nouvelle intervention</label>
<?php formatBox("Nécessite_un_nouvelle_intervention", ""); ?>
</div>

<br>


<div class="block bordure" id="mat_util">
<p>Matériaux utilisés</p>
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

</body>
</html>