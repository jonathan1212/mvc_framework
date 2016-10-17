<?php 
    use Helpers\Url; 
    use Core\View;
?>
<link rel="stylesheet" type="text/css" href="app/templates/default/css/modal.css">

<div class="row">
    <h2>post</h2>
	<div class="dataTables_wrapper form-inline">
        <div class="table-responsive">
            <a href="/post/add"> Add </a>
            <table class="table table-hover">
                <thead>
                    <tr role="row">
                        <td>Process</td>
						<th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Filename</th>
                        <th>Date created</th>
                        <th>Date updated</th>
                        <th>Status</th>

                    </tr>
                </thead>

                <tbody>
            		<?php foreach($data['post'] as $post): ?>
                      	<tr role="row">
                            <td><a href="<?php echo 'post/edit/'. $post->getId()  ?>"> Edit </a> | 
                                <a href="<?php echo 'post/delete/'. $post->getId()  ?>"> Delete </a> |
                                <a class="comment" href="#openModal" data-id="<?php echo $post->getId() ?>"> Comment </a>
                            </td>
                            <td><?php echo $post->getId() ?></td>
                        	<td><?php echo $post->getAuthor()->getFullName() ?></td>
                       	    <td><?php echo $post->getTitle() ?></td>
                            <td><?php echo $post->getContent() ?></td>
                            <td><img src="<?php echo Url::templatePath().'images/'. $post->getFilename() ?>" width="50"/> </td>
                            <td><?php echo $post->getDateCreated() ?></td>
                            <td><?php echo $post->getDateUpdated() ?></td>
                            <td><?php echo $post->getStatus() ?></td>
                        </tr>
               		<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php echo $data['pages']->pageLinks();  ?>

</div>
<?php View::render('post/_modal') ?>

<script type="text/javascript" src="app/templates/default/js/post.js"></script>
