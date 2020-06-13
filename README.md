#ContactForm
<ol>
    <li>
        Installation Symfony CLI [download](https://symfony.com/download)
        <ul>
            <li>
                <code> composer install</code>
            </li>
            <li>
                <code> symfony console doctrine:database:create</code>
            </li>
            <li>
                <code> symfony console make:migration</code>
            </li>
             <li>
                <code> symfony console doctrine:migrations:migrate</code>
             </li>
             <li>
                <code> symfony server:start</code>
             </li>
        </ul>
    </li>
     <li>
            Recettes
            <ul>list
            <ul>
                <li><code>127.0.0.1:8000/</code></li>
             </ul>         
         </ul>
         <ul>Create
         <ul>
         <li><code>127.0.0.1:8000/recette/new</code></li>
         </ul>         
         </ul>
         <ul>Update
         <ul>
         <li><code>127.0.0.1:8000/recette/{id}/edit</code></li>
         </ul>
         </ul>
         <ul>Delette
         <ul>
         <li><code>127.0.0.1:8000/recette/drop/{id}</code></li>
         </ul>
         </ul>
        </li>
    <li>
        API Rest Documentation
        <ul>
            <li>
                <code>127.0.0.1:8000/api</code>
            </li>
        </ul>
    </li>
   </ol>
