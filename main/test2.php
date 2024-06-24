<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<link href= 
"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
		rel="stylesheet"> 
	<script src= 
"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"> 
	</script> 

</head> 

<body> 
	<div class="container"> 
		<h1 class="text-success"> 
			GeeksforGeeks 
		</h1> 
		<h2> 
			Multiple Selection Dropdown with Checkbox 
		</h2> 

		<div class="dropdown"> 
			<button class="btn btn-success dropdown-toggle"
					type="button"
					id="multiSelectDropdown"
					data-bs-toggle="dropdown"
					aria-expanded="false"> 
				Select 
			</button> 
			<ul class="dropdown-menu"
				aria-labelledby="multiSelectDropdown">
			     <?php
             include "conn.php";

              // Query to fetch categories
              $categoryQuery = "SELECT DISTINCT Branch FROM all_devices where company_code = '02'";
              $categoryResult = $connection->query($categoryQuery);

              while ($categoryRow = $categoryResult->fetch_assoc()) {
                  $categoryId = $categoryRow['Branch'];
                  $categoryName = $categoryRow['Branch'];
                  ?>
                  <li class="dropdown-item">
                    <input type="checkbox" class="category-checkbox" name="categories[]" value="<?php echo $categoryId; ?>"> <?php echo $categoryName; ?>
                  </li> 
                   <?php
                  $subcategoryQuery = "SELECT Device_id FROM all_devices WHERE Branch = '$categoryId'";
                  $subcategoryResult = $connection->query($subcategoryQuery);

                  while ($subcategoryRow = $subcategoryResult->fetch_assoc()) {
                      $subcategoryName = $subcategoryRow['Device_id'];
                      $subcategoryValue = $subcategoryRow['Device_id'];
                      ?>
                      <li class="dropdown-item">
                        <input type="checkbox" class="category-checkbox" name="subcategories[]" value="<?php echo $subcategoryValue; ?>"> <?php echo $subcategoryName; ?>
                      </li>
                      <?php
                  }
              }
              ?>
			
			</ul> 
		</div> 
	</div> 

<!--	<script> 
		const dropdownButton = 
			document.getElementById('multiSelectDropdown'); 
		const dropdownMenu = 
			document.querySelector('.dropdown-menu'); 
		let mySelectedItems = []; 

		function handleCB(event) { 
			const checkbox = event.target; 
			if (checkbox.checked) { 
				mySelectedItems.push(checkbox.value); 
			} else { 
				mySelectedItems = 
				mySelectedItems.filter((item) => item !== checkbox.value); 
			} 

			dropdownButton.innerText = mySelectedItems.length > 0 
				? mySelectedItems.join(', ') : 'Select Items'; 
		} 

		dropdownMenu.addEventListener('change', handleCB); 
	</script> -->
<script>
  const dropdownButton = document.getElementById('multiSelectDropdown');
  const dropdownMenu = document.querySelector('.dropdown-menu');
  const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
  const subcategoryCheckboxes = document.querySelectorAll('.subcategory-checkbox');
  let mySelectedItems = [];

  function handleCB(event) {
    const checkbox = event.target;
    if (checkbox.classList.contains('category-checkbox')) {
      // Handle category checkbox selection
      const subcategoryCheckboxesInCategory = checkbox.parentNode.nextElementSibling.querySelectorAll('.subcategory-checkbox');
      if (checkbox.checked) {
        // Select all subcategory checkboxes in the category
        subcategoryCheckboxesInCategory.forEach(subcategoryCheckbox => {
          if (!subcategoryCheckbox.checked) {
            subcategoryCheckbox.checked = true;
            mySelectedItems.push(subcategoryCheckbox.value);
          }
        });
      } else {
        // Deselect all subcategory checkboxes in the category
        subcategoryCheckboxesInCategory.forEach(subcategoryCheckbox => {
          if (subcategoryCheckbox.checked) {
            subcategoryCheckbox.checked = false;
            mySelectedItems = mySelectedItems.filter(item => item !== subcategoryCheckbox.value);
          }
        });
      }
    } else if (checkbox.classList.contains('subcategory-checkbox')) {
      // Handle subcategory checkbox selection
      if (checkbox.checked) {
        mySelectedItems.push(checkbox.value);
      } else {
        mySelectedItems = mySelectedItems.filter(item => item !== checkbox.value);
      }

      // Update the category checkbox state based on subcategory selection
      const categoryCheckbox = checkbox.closest('.dropdown-menu').previousElementSibling.querySelector('.category-checkbox');
      const subcategoryCheckboxesInCategory = checkbox.closest('.dropdown-menu').querySelectorAll('.subcategory-checkbox');
      const allSubcategoriesSelected = Array.from(subcategoryCheckboxesInCategory).every(subcategoryCheckbox => subcategoryCheckbox.checked);
      categoryCheckbox.checked = allSubcategoriesSelected;
    }

    dropdownButton.innerText = mySelectedItems.length > 0
      ? mySelectedItems.join(', ')
      : 'Select Items';
  }

  dropdownMenu.addEventListener('change', handleCB);
  categoryCheckboxes.forEach(checkbox => checkbox.addEventListener('change', handleCB));
  subcategoryCheckboxes.forEach(checkbox => checkbox.addEventListener('change', handleCB));
</script>
</body> 

</html>
