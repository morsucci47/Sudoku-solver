<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Sudoku Solver - Porting Borland 6</title>
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=0.8">
</head>

<body onload="caricaListaSudoku()">

<div id="container">
        <h1 style="margin-top: 1px;">OrMa Sudoku Tutor</h1>
        
<table id="sudoku-grid" style="border: 3px solid black;">
    <?php for($r=0; $r<9; $r++): ?>
    <tr>
        <?php for($c=0; $c<9; $c++): 
            // Calcoliamo le classi per i bordi spessi  && $c < 8  && $r < 8
            $classes = "";
            if (($c + 1) % 3 == 0 ) $classes .= " thick-right";
            if (($r + 1) % 3 == 0 ) $classes .= " thick-bottom";
            if ($c == 0 ) $classes .= " thick-left";
            if ($r == 0 ) $classes .= " thick-top";
        ?>
            <td class="<?php echo $classes; ?>">
                <input type="number" min="1" max="9" id="cell-<?php echo "$r-$c"; ?>" autocomplete="off">
            </td>
        <?php endfor; ?>
    </tr>
    <?php endfor; ?>
</table>
<!--<label for="sudoku-progress">Avanzamento:</label>
<progress id="progressBar" value="0" max="100"></progress>
<span id="progressValue">0%</span>-->

	<div id="sudoku-mask" style="width: 456px; margin: 5px auto;">
		<h4 style="text-align: center; margin-bottom: 2px;">Opzioni di Ricerca</h4>
		
		<table style="width: 100%; border-collapse: collapse; border: none; table-layout: fixed;">
			<tr>
				<td style="vertical-align: top; padding: 5px; border: none;">
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="righeChecked" checked> Righe</label>
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="colonneChecked" checked> Colonne</label>
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="quadriChecked" checked> Quadrati</label>
				</td>

				<td style="vertical-align: top; padding: 5px; border: none;">
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="singoliChecked" checked> Unicità</label>
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="biunicitaChecked" > Bi-unicità</label>
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="doppiniChecked" > Doppini</label>
				</td>

				<td style="vertical-align: top; padding: 5px; border: none;">
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="tripliniChecked" > Triplini</label>
					<!--<hr style="margin: 5px 0; border: 0; border-top: 1px solid #ccc;">-->
					<label style="display: block; margin-bottom: 5px;text-align: left;"><input type="checkbox" id="checkIntersChecked" > Intersezioni</label>
					<label style="display: block; margin-bottom: 5px; text-align: left;">
						<input type="number" id="cifraSel" style="width: 30px;"> SelXambig
					</label>				
				</td>
			</tr>
		</table>

	</div>

	<div id="controls">
		<button onclick="reset()">Azzera</button>		
		<input type="file" id="caricaFile" style="display:none" onchange="caricaSudoku(event)">
		<!--&nbsp&nbsp&nbsp&nbsp-->
		<button onclick="document.getElementById('caricaFile').click()">Importa</button>           		
		<!--&nbsp&nbsp&nbsp&nbsp-->
		<button onclick="salvaSudoku()">Esporta</button>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="generaSudoku()">Crea</button>
		<button onclick="togliTutto()">Togli</button>

		<br>
		<br>
		<button onclick="eseguiGiro()">Possibilità</button>
        <!--<button onclick="eseguiEliminaNple()">Elimina Nple</button>-->
		<button onclick="risolviTutto()">Risolvi Tutto</button>			
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="comandoIndietro()">Indietro</button>
		&nbsp&nbsp
		<button onclick="Passo()">Passo</button>			
		<br>
		<br>
		<button onclick="Ambiguita()">Ambiguità</button>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="window.open('./doc/Sudoku_tecnicheA5.pdf', '_blank')">
			Documentazione
		</button>
		<button onclick="window.open('./help/Introduzione.html', '_blank')">
			Help
		</button>
		<button onclick="Esempio()">Demo</button>
		<br>
		<br>
		<div id="sezione-salvataggio" style="margin: 1px 0; padding: 10px; border: 1px solid #ccc;">
			<!--<h5>Registrazione</h5>-->
			
			<!--<label for="input-nome">Nome Sudoku:</label>-->
			<input type="text" id="input-nome" placeholder="Nome del Sudoku">
			
			<!--<label for="select-livello">Liv.</label>&nbsp&nbsp&nbsp&nbsp-->
			<select id="select-livello">
				<option value="facile">Facile</option>
				<option value="medio" selected>Medio</option>
				<option value="difficile">Difficile</option>
			</select>

			<button onclick="preparaSalvataggio()">Registra</button>
			<select id="menu-sudoku">
				<option value="">...</option>
			</select>		
		</div>		
		
	</div>

	<div id="log-window">
		<!--<h3>Registro delle Operazioni</h3>-->
		<textarea id="memo1" readonly rows="10" cols="50"></textarea>
	</div>
</div>



<!--<textarea id="memo1" rows="10" cols="50" readonly placeholder="Log operazioni..."></textarea>-->

	<!-- costringe a caricare l'ultima versione dello script -->
<script src="script.js?v=<?php echo filemtime('script.js'); ?>"></script>
	<!-- <script src="script.js?v=1.2"></script> -->
	
</body>
</html>