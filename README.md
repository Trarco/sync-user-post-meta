# Sync User Post Meta

**Sync User Post Meta** è un plugin WordPress che consente di sincronizzare i meta dati tra gli utenti e i post. Utilizza uno shortcode per aggiornare i meta dati dei post basati sui meta dati dell'utente o viceversa.

## Caratteristiche

- **Pagina di Amministrazione**: Interfaccia per sincronizzare i meta dati degli utenti con i post precedenti.
- **Shortcode**: `[sync_user_post_meta source="user" meta="nome_del_meta"]` per sincronizzare i meta dati tra post e utenti.
- **Sincronizzazione AJAX**: Carica dinamicamente i meta key disponibili per l'utente selezionato.

## Installazione

1. **Carica il Plugin**: Carica la cartella del plugin `sync-user-post-meta` nella directory `wp-content/plugins`.
2. **Attiva il Plugin**: Vai su `Plugin` nella dashboard di WordPress e attiva **Sync User Post Meta**.
3. **Configura il Plugin**:
   - Vai su **Sync Meta** nel menu di amministrazione di WordPress.
   - Seleziona un utente, un meta key, e i tipi di post per sincronizzare i meta dati.
   - Clicca su **Sincronizza i post con il Meta Dato utente** per avviare il processo di sincronizzazione.

## Utilizzo dello Shortcode

Aggiungi il seguente shortcode in un post o una pagina per sincronizzare i meta dati:

```plaintext
[sync_user_post_meta source="user" meta="nome_del_meta"]
```

- `source`: Indica la fonte del meta dato (`user` o `post`).
- `meta`: Nome del campo meta da sincronizzare.

### Esempio

Se desideri sincronizzare un meta dato da un utente a un post:

```plaintext
[sync_user_post_meta source="user" meta="custom_meta_key"]
```

## Funzioni del Plugin

- **`get_user_meta_keys($user_id)`**: Restituisce tutte le chiavi dei meta dati per un utente specifico.
- **`manual_sync_all_posts($user_id, $meta_key, $post_types)`**: Sincronizza i meta dati tra gli utenti e i post.

## Contributi

Se desideri contribuire al progetto, segui questi passaggi:

1. Fai un fork del repository.
2. Crea un ramo (`branch`) per la tua modifica.
3. Invia una pull request con una descrizione chiara delle modifiche.

## Licenza

Questo plugin è concesso in licenza sotto la Licenza GPLv2 o successiva. Consulta il file LICENSE per i dettagli.

## Supporto

Per assistenza o segnalazione di bug, apri una [issue](https://github.com/Trarco/sync-user-post-meta/issues) su GitHub.

## Autore

**Marco Traina**  
[Website](https://www.trainaepartners.it)  
[Email](mailto:info@trainaepartners.it)
```

### Note:

1. **Personalizza il link di supporto** e i dettagli di contatto con i tuoi dati reali.
2. **Aggiorna il nome utente GitHub e il repository** nei link delle issue e nella sezione "Contributi" se non è ancora stato creato.

Se hai altre preferenze o ulteriori dettagli da includere, fammi sapere!