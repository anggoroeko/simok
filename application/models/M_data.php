<?php if(!defined('BASEPATH')) exit('No direct Script Allowed');

/**
 * 
 */
class M_data extends CI_Model {

	function getDataGlobalLogin($table="", $field_param_1="", $field_param_2="", $field_param_3="", $param_1="", $param_2="", $param_3=""){
		$add_query = '';
		if(!empty($field_param_3)){
			$add_query = '{ "match": { "'.$field_param_3.'": "'.$param_3.'" } },';
		}
		$esquery = '{ "query": {
							"bool": {
								"must": [ 
									{ "bool": {
										"should": [
											{ "match_phrase": { "'.$field_param_1.'": "'.$param_1.'" } },
											{ "match_phrase": { "'.$field_param_2.'": "'.$param_2.'" } }
										]
									} },
									{ "match": { "table": "'.$table.'" } }'
										.$add_query.
								']
							}
					} }';
		
		$result = $this->elasticsearch->advancedquery('docs', $esquery);
		return $result;
	}
}