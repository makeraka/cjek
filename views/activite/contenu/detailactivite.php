<table class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer" id="kt_table_widget_4_table">
    <!--begin::Table head-->
    <thead>
        <tr class=" bg-light text-gray-900">
            <td colspan="2">ACTIVITES</td>
            <td >DATE</td>
            <td>DESCRIPTION</td>
            <td class="text-start">STATUT</td>

        </tr>

    </thead>
    <tbody>
        <?php

        if (sizeof($act) > 0) {
            // die(var_dump($act));

            foreach ($act as $key => $value) {

                if (isset($value['etat']) && $value['etat'] == 1) {
                    $statut = '<a href="javascript:;" Class="badge badge-light-success" >Terminer</a>';
                } else if (isset($value['etat']) && $value['etat'] == 2) {
                    $statut = '<span class="badge badge-light-primary">En cours</span>';
                } else {
                    $statut = '<span class="badge badge-warning"></span>';
                }
                echo ' 
          <tr data-kt-table-widget-4="subtable_template" class="">
                <td colspan="2">
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="symbol symbol-75px bg-secondary bg-opacity-25 rounded">
                            <img src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $value['photo'] . '"
                                alt="" data-kt-table-widget-4="template_image">
                        </a>
                        <div class="d-flex flex-column text-muted">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bold"
                                data-kt-table-widget-4="template_name"></a>
                            <div class="fs-2" data-kt-table-widget-4="template_description">' . $value['nom'] . '</div>
                        </div>
                    </div>
                </td>
               
                <td class="text-start">
                    <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total"> ' . $value['dateac'] . '</div>
                </td>

                <td class="text-start">
                  <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">' . $value['description'] . ' </div>
                </td>

                <td class="text-start">
                    <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">' . $statut . ' </div>
                </td>

               
            </tr>';
            }
        }
        ?>
    </tbody>
</table>