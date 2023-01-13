### v1.0.0
  - Release January 13th, 2023
  - All Carbone Cloud API endpoints are supported and tested:
    - Add template `$carbone->templates()->upload($contentBase64)`
    - Delete template `$carbone->templates()->delete($templateId);`
    - Download template `$carbone->templates()->download($templateId)`
    - Generate report from a template `$carbone->renders()->render($templateId, $data)`
    - Download a generated report `$carbone->renders()->download($renderId);`
    - Get API Status `$carbone->getStatus()`