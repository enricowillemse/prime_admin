<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ColorSelectController extends FormElementBase
{
    public function Render($name,$label)
    {
        $output=array();

        $output['style'][]='
                            .cbox {
                                height:20px
                            }
                            ';


        $output['html'][]= '<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters['.$name.']" class="form-control" data-placeholder="Choose a color scheme...">
                                        </input>
                                </div>';
        $output['js'][]= '$("#'.$name.'").select2({
                                                data:'.json_encode($this->GetColors(),true).',
                                                formatResult: function(result) {
                                                    return \'<strong>\'+result.text+\'</strong>\'
            	                                            +\'<table width="100%" class="info-table"><tbody><tr>\'
                                                            + \'<td class="cbox" style="background-color:\'+ result.c1 +\'"></td>\'
                                                            + \'<td class="cbox" style="background-color:\'+ result.c2 +\'"></td>\'
                                                            + \'<td class="cbox" style="background-color:\'+ result.c3 +\'"></td>\'
                                                            + \'<td class="cbox" style="background-color:\'+ result.c4 +\'"></td>\'
                                                            + \'<td class="cbox" style="background-color:\'+ result.c5 +\'"></td>\'
                                                            + \'</tr></tbody></table>\';
                                                }
                                            });';

        return $output;
    }

    public function GetColors()
    {
    
        $colors=array();

        $colors['Giant Goldfish']=array('#69D2E7','#A7DBDB','#E0E4CC','#F38630','#FA6900');
        $colors['Cardsox']=array('#E94C6F','#542733','#5A6A62','#C6D5CD','#FDF200');
        $colors['Fitz Fitzpatrick']=array('#DB3340','#E8B71A','#F7EAC8','#1FDA9A','#28ABE3');
        $colors['Campfire']=array('#588C73','#F2E394','#F2AE72','#D96459','#8C4646');
        $colors['Aladdin']=array('#D0C91F','#85C4B9','#008BBA','#DF514C','#DC403B');
        $colors['Chrome Sports']=array('#00C8F8','#59C4C5','#FFC33C','#FBE2B4','#FF4C65');
        $colors['Papua New Guinea']=array('#5E412F','#FCEBB6','#78C0A8','#F07818','#F0A830');
        $colors['Barni Design']=array('#DE4D4E','#DA4624','#DE593A','#FFD041','#6E9ECF');
        $colors['Instapuzzle']=array('#B1EB00','#53BBF4','#FF85CB','#FF432E','#FFAC00');
        $colors['Our Little Projects']=array('#354458','#3A9AD9','#29ABA4','#E9E0D6','#EB7260');
        $colors['State of the Owner']=array('#4298B5','#ADC4CC','#92B06A','#E19D29','#DD5F32');
        $colors['SoftwareMill']=array('#BCCF02','#5BB12F','#73C5E1','#9B539C','#EB65A0');
        $colors['iGaranti']=array('#FFA200','#00A03E','#24A8AC','#0087CB','#982395');
        $colors['Vintage Romantic']=array('#260126','#59323C','#F2EEB3','#BFAF80','#8C6954');
        $colors['Nicholas Jackson Design']=array('#BFF073','#0DC9F7','#7F7F7F','#F05B47','#ED1C24');
        $colors['1920 Leyendecker']=array('#3B3A35','#20457C','#5E3448','#FB6648','#ECDFBD');
        $colors['WerkPress']=array('#E45F56','#A3D39C','#7ACCC8','#4AAAA5','#35404F');
        $colors['Silmo Paris']=array('#DC2742','#AFA577','#ABA918','#8BAD39','#14B8B1');
        $colors['Dark Sunset']=array('#F2671F','#C91B26','#9C0F5F','#60047A','#160A47');
        $colors['The Color of Traffic']=array('#0F5959','#17A697','#638CA6','#8FD4D9','#D93240');
        $colors['MandLoys']=array('#83AA30','#1499D3','#4D6684','#3D3D3D','#E74700');
        $colors['Sa Barca de Formentera']=array('#333333','#424242','#00CCD6','#EFEFEF','#FFD900');
        $colors['Contad']=array('#CCC51C','#FFE600','#F05A28','#B9006E','#3A0256');
        $colors['Magme']=array('#F17D80','#737495','#68A8AD','#C4D4AF','#6C8672');
        $colors['Enterprise Foundation']=array('#0B99BC','#5C2D50','#D40E52','#CD1719','#FCE014');
        $colors['Scrollab']=array('#293E6A','#3B5998','#74AAF7','#77BA9B','#B6A754');
        $colors['Mohiuddin Parekh']=array('#B0A472','#F5DF65','#2B9464','#59C8DF','#D14D28');
        $colors['Boy-Coy']=array('#F15D58','#363635','#83BF17','#A68F58','#DCDDCD');
        $colors['DrupalCon']=array('#BB0F00','#6E0000','#6D2908','#1BA3E1','#02D0AC');
        $colors['Windows of New York']=array('#753A48','#954F47','#C05949','#9AADBD','#CBBB58');
        $colors['Lorenzo Verzini']=array('#F0F1EE','#333332','#1352A2','#FFD464','#FB6964');
        $colors['Raspberry Theme']=array('#591E23','#D94E67','#F2D8A7','#A68572','#73503C');
        $colors['Paw Studio']=array('#28BE9B','#92DCE0','#609194','#EF9950','#D79C8C');
        $colors['Visually Columbia']=array('#FFF568','#0C98CF','#0AA0D9','#6C6E70','#2D3033');
        $colors['Andaz']=array('#666666','#25AAA0','#66C3BC','#41D4CF','#10206B');
        $colors['Secret Key']=array('#442D65','#775BA3','#91C5A9','#F8E1B4','#F98A5F');
        $colors['FIG']=array('#493621','#82683B','#F76835','#D7D1CA','#B8BE1C');
        $colors['Viximo']=array('#57102C','#AA2159','#009D97','#7EC2AA','#BCC747');
        $colors['Osaki']=array('#FF9700','#CC6600','#999900','#333300','#660066');
        $colors['Kashi']=array('#5DB89D','#007034','#8C8535','#FFCA00','#F26547');
        $colors['Bassenettes']=array('#FF5108','#FFFDF8','#FF2321','#000000','#F7FF3F');
        $colors['Adam Hartwig']=array('#E8A0B8','#FFC300','#BCCF3D','#02C9C9','#333333');
        $colors['Alexandra Kuban Web Design']=array('#FAC8BF','#94FFFC','#466675','#6A8D9D','#CCCCCC');
        $colors['Gravual']=array('#A2D7D8','#BFE1BF','#EDEDEA','#FCD059','#DE5842');
        $colors['Scott McCarthy']=array('#D75C37','#67727A','#6991AC','#C3D7DF','#F5F5F5');
        $colors['Made Together']=array('#0','#FF534B','#021542','#0241E2','#AAAAAA');
        $colors['Aesthetic Invention']=array('#D4EDF4','#E2F2D5','#F9FBBA','#F6C2C2','#EBEBEB');
        $colors['LRXD']=array('#FE9601','#CC0063','#86269B','#00D2F1','#00B796');
        $colors['Enso']=array('#3F0082','#DFE0DB','#FF66CC','#0','#F7F960');
        $colors['El Designo']=array('#2B2301','#E2D893','#A79E65','#73AFB6','#5F9DA1');
    

        $output=array();
    foreach($colors as $key=>$value)
    {
        $output[]=array("id"=>json_encode($value,true), "text"=>$key, "c1"=>$value[0],"c2"=>$value[1],"c3"=>$value[2],"c4"=>$value[3],"c5"=>$value[4]);
    }
    

    return $output;
    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        echo json_encode($data);
    }

}
