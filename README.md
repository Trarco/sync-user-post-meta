Certo! Ecco la versione in inglese del file `README.md`:

# Sync User Post Meta (ENGLISH)

**Sync User Post Meta** is a WordPress plugin that allows you to synchronize meta data between users and posts. It uses a shortcode to update post meta data based on user meta data or vice versa.

## Features

- **Admin Page**: Interface for synchronizing user meta data with posts.
- **Shortcode**: `[sync_user_post_meta source="user" meta="meta_name"]` to synchronize meta data between posts and users.
- **AJAX Synchronization**: Dynamically loads available meta keys for the selected user.

## Installation

1. **Upload the Plugin**: Upload the `sync-user-post-meta` folder to the `wp-content/plugins` directory.
2. **Activate the Plugin**: Go to `Plugins` in the WordPress dashboard and activate **Sync User Post Meta**.
3. **Configure the Plugin**:
   - Go to **Sync Meta** in the WordPress admin menu.
   - Select a user, a meta key, and post types to synchronize meta data.
   - Click **Sync Posts with User Meta Data** to start the synchronization process.

## Using the Shortcode

Add the following shortcode to a post or page to synchronize meta data:

```plaintext
[sync_user_post_meta source="user" meta="meta_name"]
```

- `source`: Indicates the source of the meta data (`user` or `post`).
- `meta`: Name of the meta field to synchronize.

### Example

To synchronize a meta data from a user to a post:

```plaintext
[sync_user_post_meta source="user" meta="custom_meta_key"]
```

## Plugin Functions

- **`get_user_meta_keys($user_id)`**: Returns all meta keys for a specific user.
- **`manual_sync_all_posts($user_id, $meta_key, $post_types)`**: Synchronizes meta data between users and posts.

## Contributing

If you wish to contribute to the project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your modification.
3. Submit a pull request with a clear description of the changes.

## License

This plugin is licensed under the GPLv2 or later. See the LICENSE file for details.

## Support

For assistance or to report bugs, open an [issue](https://github.com/your-username/sync-user-post-meta/issues) on GitHub.

## Author

**Marco Traina**  
[Website](https://www.trainaepartners.it)  
[Email](mailto:info@trainaepartners.it)

# Sync User Post Meta (ITALIANO)

**Sync User Post Meta** è un plugin WordPress che consente di sincronizzare i meta dati tra gli utenti e i post. Utilizza uno shortcode per aggiornare i meta dati dei post basati sui meta dati dell'utente o viceversa.

## Caratteristiche

- **Pagina di Amministrazione**: Interfaccia per sincronizzare i meta dati degli utenti con i post precedenti.
- **Shortcode**: `[sync_user_post_meta source="user" meta="meta_name"]` per sincronizzare i meta dati tra post e utenti.
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
[sync_user_post_meta source="user" meta="meta_name"]
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

Per assistenza o segnalazione di bug, apri una [issue](/Trarco/sync-user-post-meta/issues) su GitHub.

## Autore

**Marco Traina**  
[Website](https://www.trainaepartners.it)  
[Email](mailto:info@trainaepartners.it)