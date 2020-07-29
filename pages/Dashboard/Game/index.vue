<template>
    <b-card title="Card Title" no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs>
            <b-nav-item  href="/../dashboard" >Informations principales</b-nav-item>
            <b-nav-item  href="./allTickets">Tous les tickets gagnants</b-nav-item>
            <b-nav-item  active href="#">Game Fatboar</b-nav-item>
          </b-nav>
        </b-card-header>
        <b-card-body class="text-justify">
          <b-card-text>
          Le jeu sera automatisé tous les jours à 20 h mais si une panne survenait cliquer sur ce bouton pour relancer le jeu
          </b-card-text>
          <b-button variant="success" href="">Lancer le Jeu</b-button>
        </b-card-body>
    </b-card>
</template>