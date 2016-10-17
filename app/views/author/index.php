<div class="row">
    <h2>Author</h2>
	<div class="dataTables_wrapper form-inline">
        <div class="table-responsive">
            <a href="/author/add"> Add </a>
            <table class="table table-hover">
                <thead>
                    <tr role="row">
                        <td>Process</td>
						<th>Id</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>

                <tbody>
            		<?php foreach($data['author'] as $author): ?>
                      	<tr role="row">
                            <td><a href="<?php echo 'author/edit/'. $author->getId()  ?>"> Edit </a> </td>
                            <td><?php echo $author->getId() ?></td>
                        	<td><?php echo $author->getFullName() ?></td>
                       	    <td><?php echo $author->getEmail() ?></td>
                            <td><?php echo $author->getPassword() ?></td>
                        </tr>
               		<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>