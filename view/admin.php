<?php include('./view/background.php'); ?>


    <h2>Panneau d'administration</h2>
    
    <form id='adminChaptersList' method='post' action='/?admin'>
       <input type='hidden' name='chaptersPublicationInfos' value='save' />
        <div class='formTableContainer'>
        <table>
            <caption>Liste des chapitres</caption>
            <thead>
                <tr>
                    <th>Titre du chapitre</th>
                    <th>Publier</th>
                    <th><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>

            <?php
                $chapterNbr = 0;
                foreach ($chapters as $chapter)
                {
                    if ($chapter->published()) {
                        $chapterNbr++;
            ?>

                <tr>
                    <td>
                        <a href='/?admin&toedit=chapter&id=<?= $chapter->id() ?>'><?= 'Chapitre ' . $chapterNbr . ' : ' . $chapter->title() ?></a>
                    </td>
                    <td>
                        <input type='checkbox' checked name='publication<?= $chapter->id() ?>' />
                    </td>
                    <td>
                        <input type='checkbox' name='delete<?= $chapter->id() ?>' />
                    </td>
                </tr>

            <?php
                    }
                }
                
                foreach ($chapters as $chapter)
                {
                    if (!$chapter->published()) {
                        $chapterNbr++;
            ?>

                <tr>
                    <td>
                        <a href='/?admin&toedit=chapter&id=<?= $chapter->id() ?>'><?= $chapter->title() ?></a>
                    </td>
                    <td>
                        <input type='checkbox' name='publication<?= $chapter->id() ?>' />
                    </td>
                    <td>
                        <input type='checkbox' name='delete<?= $chapter->id() ?>' />
                    </td>
                </tr>

            <?php
                    }
                }
            ?>
    
            </tbody>
        </table>
        </div>
        
        <div class='buttonsBox'>
            <input name='newChapter' class='bigButton' type='submit' value='Nouveau chapitre' />
            <input name='chaptersPublicationInfosSave' class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>
    
    
    
    
    
    
    
    
    
    <form id='adminComment' method='post' action='/?admin'>
        <label for='editedComment'>Commentaire sélectionné :</label>
        <textarea id='editedComment' name='editedContent'>
        </textarea>
        
        <div class='buttonsBox'>
            <input class='bigButton' type='submit' name='commentEditionSave' value='Sauvegarder'/>
        </div>
    </form>
    
    
    <div class='tableContainer'>
        <table id='adminCommentsList'>
            <caption>Commentaires signalés</caption>
            <thead>
                <tr>
                    <th>Chap.</th>
                    <th>Auteur</th>
                    <th>Commentaire</th>
                    <th>Ignor.</th>
                    <th><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>9</a></td>
                    <td>PenguinLover</td>
                    <td>Ceci est un commentaire. Je n'ai rien d'intéressant à dire, c'est pourquoi j'écris un commentaire...</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>12</a></td>
                    <td>N00bKi77eR</td>
                    <td>Wesh ! Vas-y que j'te laisse un comment sur ton blog !</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>1</a></td>
                    <td>LinguisteEnHerbe</td>
                    <td>Lamentable de voir que même un 'grand' auteur, ne sait pas écrire correctement. Ce texte est truffé de fautes d'orthographe.</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>7</a></td>
                    <td>BestOfTrolls</td>
                    <td>Joli bouquin, ça ma rappelle Mein Kampf, le style en moins.</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>5</a></td>
                    <td>KikooLol08</td>
                    <td>Tro mimi tro chou, JTM Jean Forteroche !!!</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>1</a></td>
                    <td>LeBonSouk.com</td>
                    <td>Achetez 'Lorem ipsum' sur LeBonSouk.com et profitez d'une réduction de 85% !!!</td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
                <tr>
                    <td><a href='./?chapter&id=9' target=_blank>8</a></td>
                    <td>BêteÀMangerDuFoin</td>
                    <td>J'ai rien compris. O_O' </td>
                    <td><input type='checkbox' name='ignore' /></td>
                    <td><input type='checkbox' name='delete' /></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    
    
    
    
    
    
    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>
    

<?php include('./view/footer.php'); ?>