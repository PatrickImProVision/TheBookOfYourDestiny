# Get Current Folder
$Folder = $PSScriptRoot
$Files = Get-ChildItem -Path $Folder -Filter *.json -Recurse |
    Where-Object {
        $_.FullName -notmatch '\\.vs\\' -and
        $_.FullName -notmatch '\\.vscode\\' -and
        $_.FullName -notmatch '\\.git\\'
    }


$Index = $Files | Select-Object `
    FullName,
    Name,
    DirectoryName,
    Length,
    Extension,
    CreationTime,
    LastWriteTime

$Index | ConvertTo-Json -Depth 5 | Out-File "$Folder\The_Index_Files.json"