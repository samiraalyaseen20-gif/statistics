import os

with open(r'd:\smira progickt\statistics\extract_all.py', 'r', encoding='utf-8') as f:
    content = f.read()

new_block = """
        # 0. Clinics Visits
        if "اسم الوحدة الطبية" in headers:
            for r in rows[1:]:
                cells = [clean_text(c.text) for c in r.cells]
                if len(cells) >= 3 and cells[1] and cells[2].isdigit():
                    data["clinics_visits"].append({"clinic": cells[1], "count": int(cells[2])})
"""

content = content.replace('data = {', 'data = {\n        "clinics_visits": [],')
content = content.replace('# 1. Doctors Visits', new_block + '\n        # 1. Doctors Visits')

with open(r'd:\smira progickt\statistics\extract_all.py', 'w', encoding='utf-8') as f:
    f.write(content)
