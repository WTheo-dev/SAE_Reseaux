#!/bin/bash

/opt/lampp/bin/mysql < /opt/lampp/htdocs/SAE_RESEAUX_MODIF/BDD/bdd_create.sql
/opt/lampp/bin/mysql < /opt/lampp/htdocs/SAE_RESEAUX_MODIF/BDD/bdd_tables.sql
/opt/lampp/bin/mysql < /opt/lampp/htdocs/SAE_RESEAUX_MODIF/BDD/bdd_data.sql
