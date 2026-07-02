import docx
import json
import os
import sys
import io

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

folder = r"d:\smira progickt\New folder"
months_files = {
    "1": {"type1": "احصائية_تفصيلية_لكل_طبيب_يناير_2026_.docx", "type2": "شهر 1 2026.docx"},
    "2": {"type1": "احصائية تفصيلية لكل طبيب شباط2026.docx", "type2": "شهر 2 2026.docx"},
    "3": {"type1": "احصائية_تفصيلية_لكل_طبيب_اذار2026_Copy.docx", "type2": "شهر 3  عتبة2026.docx"},
    "4": {"type1": "احصائية_تفصيلية_لكل_طبيب_نيسان2026_Copy_Copy.docx", "type2": "شهر4عتبة2026.docx"},
    "5": {"type1": "احصائية_تفصيلية_لكل_طبيب_ايار_2026_.docx", "type2": "شهر5عتبة2026.docx"},
    "6": {"type1": "احصائية_تفصيلية_لكل_طبيب_حزيران2026_Copy_Copy.docx", "type2": "شهر6عتبة2026.docx"}
}

def clean_text(text): return text.strip().replace('\n', ' ')

results = json.load(open(r"d:\smira progickt\statistics\database\data\extracted_statistics.json", "r", encoding="utf-8"))

for month, files in months_files.items():
    file_path = os.path.join(folder, files["type1"])
    doc = docx.Document(file_path)
    
    surgeries_by_doc = []
    current_doc = None
    
    for element in doc.element.body:
        if element.tag.endswith('p'):
            p = docx.text.paragraph.Paragraph(element, doc)
            text = clean_text(p.text)
            if ("-د." in text or "- د." in text or text.startswith("د.")):
                current_doc = text.split("-")[-1].strip()
        elif element.tag.endswith('tbl') and current_doc:
            table = docx.table.Table(element, doc)
            rows = table.rows
            if len(rows) < 2: continue
            headers = [clean_text(c.text) for c in rows[0].cells]
            if "اسم العملية" in headers:
                for r in rows[1:]:
                    cells = [clean_text(c.text) for c in r.cells]
                    if len(cells) >= 3 and cells[0].isdigit():
                        surgeries_by_doc.append({
                            "doctor": current_doc,
                            "operation": cells[2],
                            "classification": cells[1],
                            "count": int(cells[0])
                        })
                current_doc = None 
    
    results[month]["surgeries_by_doc"] = surgeries_by_doc

with open(r"d:\smira progickt\statistics\database\data\extracted_statistics.json", "w", encoding="utf-8") as f:
    json.dump(results, f, ensure_ascii=False, indent=4)
print("Done!")
