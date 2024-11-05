### v2.0.0
  - Release November 4th, 2024
  - Update all dependencies + PHP >= v8.2

### v1.0.1
  - Release February 16th, 2023
  - Remove unused dep "spatie/data-transfer-object" & "spatie/ray"

### v1.0.0
  - Release January 13th, 2023
  - All Carbone Cloud API endpoints are supported and tested:
    - Add template `$carbone->templates()->upload($contentBase64)`
    - Delete template `$carbone->templates()->delete($templateId);`
    - Download template `$carbone->templates()->download($templateId)`
    - Generate report from a template `$carbone->renders()->render($templateId, $data)`
    - Download a generated report `$carbone->renders()->download($renderId);`
    - Get API Status `$carbone->getStatus()`