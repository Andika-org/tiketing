<?php 
class Pagepagination extends CI_Model{
	//-- ini isinya hanya setingan pagination aja buat di view
	public function optioncode($qcount,$limitperpage,$postpage,$functionjquerytosearch){

		$pagination = "";

		$pagemax = ceil($qcount/$limitperpage);

		if($pagemax > 0){

			$batasawal		= $postpage;
			$lengthpage		= $batasawal + 2;

			$htngprev = $batasawal-1;
			if($htngprev > 0){
				$onclickprev = $functionjquerytosearch."('".$htngprev."')";
			}else{
				$onclickprev = "";
			}

            $onclickfirst = $functionjquerytosearch."('1')";

			$pagination .= '
			<nav aria-label="...">
				<ul class="pagination float-center">
					<li class="page-item" onclick="'.$onclickprev.'">
						<span class="page-link" style="cursor:pointer;">Prev</span>
                    </li>
                    <li class="page-item" onclick="'.$onclickfirst.'">
						<span class="page-link" style="cursor:pointer;">First</span>
					</li>';

					$minawalpage 	= $batasawal-1;

				if($minawalpage > 0){

					$onclickpagefirst = $functionjquerytosearch."('".$minawalpage."')";
					$pagination .= '
						<li class="page-item" onclick="'.$onclickprev.'">
							<span class="page-link" style="cursor:pointer;">'.$minawalpage.'</span>
						</li>';
					
					$plusawalpage 	= $batasawal;
					$minlengthpage 	= $lengthpage-1;
				}else{
					$pagination .= '';
					$plusawalpage 	= $batasawal;
					$minlengthpage 	= $lengthpage;
				}

			for($i=$batasawal;$i<=$minlengthpage;$i++){

				if($i<=$pagemax){
					if($batasawal == $i){
						$active = "active";
					}else{
						$active = "";
					}

					$onclickpage = $functionjquerytosearch."('".$i."')";

					$pagination .= '
						<li class="page-item '.$active.'" onclick="'.$onclickpage.'">
							<span class="page-link" style="cursor:pointer;">'.$i.'</span>
						</li>
						';
				}else{
					$pagination .= '';
				}
			}

					$onclickpagelast = $functionjquerytosearch."('".$pagemax."')";

					$htungpagenext = $postpage+1;
					if($htungpagenext > $pagemax){
						$onclicknext = "";
					}else{
						$onclicknext = $functionjquerytosearch."('".$htungpagenext."')";
					}

					$pagination .= '
						<li class="page-item">
							<span class="page-link" style="cursor:pointer;">...</span>
						</li>
						<li class="page-item">
							<span class="page-link" style="cursor:pointer;" onclick="'.$onclickpagelast.'">'.$pagemax.'</span>
						</li>
						<li class="page-item">
							<span class="page-link" style="cursor:pointer;" onclick="'.$onclicknext.'" >Next</span>
						</li>
					</ul>
				</nav>';
        }	
        
        return $pagination;
		
	}
	
}
?>