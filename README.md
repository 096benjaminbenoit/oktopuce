# oktopuce

## Installation
Il est necessaire de generer une paire de clés pour l'authentification:
```bash
symfony console lexik:jwt:generate-keypair
```

## Tests
Pour executer les test, il est necessaire d'executer les fixtures, pour mettre en place:
```bash
# Créer la base de données
symfony console doctrine:datbase:create --env=test
symfony console doctrine:schema:create --env=test
# Executer les fixtures
symfony console doctrine:fixture:load --env=test
```