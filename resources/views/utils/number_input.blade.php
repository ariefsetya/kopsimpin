<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxcore.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxdata.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxtree.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxcheckbox.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxnumberinput.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxbuttons.js');?>"></script>
<script type="text/javascript">
$(".for_numberinput").jqxNumberInput({ spinMode:'simple',digits:16, max:999999999999999999999999999999999,symbol:'Rp. '});
$(".for_numberinput_dis").jqxNumberInput({ disabled:true, spinMode:'simple',digits: 16, max:999999999999999999999999999999999,symbol:'Rp. '});
</script>
<style type="text/css">
	.for_numberinput_dis,.for_numberinput{
		height:34px !important;
		width:100% !important;
	}
	input.jqx-input-content.jqx-widget-content{
		padding: 0px !important;
		height:auto !important;
		width:100% !important;
		outline: none !important;
	}
</style>